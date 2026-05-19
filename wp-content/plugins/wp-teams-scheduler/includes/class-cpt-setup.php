<?php
class WPTS_CPT_Setup {

    public function __construct() {
        add_action( 'init', [ $this, 'register_cpts' ] );
        add_action( 'add_meta_boxes', [ $this, 'add_event_type_meta_boxes' ] );
        add_action( 'save_post', [ $this, 'save_event_type_meta' ] );
    }

    public function register_cpts() {
        // CPT: Event Type
        $labels_event_type = [
            'name'                  => _x( 'Event Types', 'Post type general name', 'wp-teams-scheduler' ),
            'singular_name'         => _x( 'Event Type', 'Post type singular name', 'wp-teams-scheduler' ),
            // ... other labels
        ];
        $args_event_type = [
            'labels'             => $labels_event_type,
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [ 'slug' => 'event-type' ],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-calendar-alt',
            'supports'           => [ 'title', 'editor' ],
        ];
        register_post_type( 'event_type', $args_event_type );

        // CPT: Booking
        $labels_booking = [
            'name'                  => _x( 'Bookings', 'Post type general name', 'wp-teams-scheduler' ),
            'singular_name'         => _x( 'Booking', 'Post type singular name', 'wp-teams-scheduler' ),
            // ... other labels
        ];
        $args_booking = [
            'labels'             => $labels_booking,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => 'edit.php?post_type=event_type',
            'query_var'          => false,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'supports'           => [ 'title' ],
            'capabilities' => [
                'create_posts' => 'do_not_allow', // prevent manual creation
            ],
            'map_meta_cap' => true,
        ];
        register_post_type( 'booking', $args_booking );
    }

    public function add_event_type_meta_boxes() {
        add_meta_box(
            'wpts_event_type_details',
            'Event Details',
            [ $this, 'render_event_type_meta_box' ],
            'event_type',
            'normal',
            'high'
        );
    }

    public function render_event_type_meta_box( $post ) {
        wp_nonce_field( 'wpts_save_event_meta', 'wpts_event_meta_nonce' );

        $duration = get_post_meta( $post->ID, '_event_duration', true );
        $teams_enabled = get_post_meta( $post->ID, '_event_teams_enabled', true );
        $is_popular = get_post_meta( $post->ID, '_event_is_popular', true );
        $team_id = get_post_meta( $post->ID, '_event_team_id', true );
        ?>
        <p>
            <label for="wpts_event_duration"><strong>Duration (in minutes):</strong></label><br/>
            <input type="number" id="wpts_event_duration" name="wpts_event_duration" value="<?php echo esc_attr( $duration ); ?>" min="1" />
        </p>
        <p>
            <label for="wpts_event_team_id"><strong>Team/Group ID:</strong></label><br/>
            <input type="text" id="wpts_event_team_id" name="wpts_event_team_id" value="<?php echo esc_attr( $team_id ); ?>" style="width: 100%; max-width: 400px;" placeholder="e.g., sales-team, support-team" />
            <br/>
            <small style="color: #666;">Events with the same Team ID will share availability. When a time is booked in one event, it won't be available in other events with the same Team ID.</small>
        </p>
        <p>
            <label for="wpts_event_teams_enabled">
                <input type="checkbox" id="wpts_event_teams_enabled" name="wpts_event_teams_enabled" value="1" <?php checked( $teams_enabled, '1' ); ?> />
                <strong>Enable meeting link creation (Microsoft Teams only)</strong>
            </label>
            <br/>
            <small style="color: #666;">Google Meet / Jitsi links are controlled by the global meeting provider setting.</small>
        </p>
        <p>
            <label for="wpts_event_is_popular">
                <input type="checkbox" id="wpts_event_is_popular" name="wpts_event_is_popular" value="1" <?php checked( $is_popular, '1' ); ?> />
                <strong>Mark as "Most Popular"</strong>
            </label>
            <br/>
            <small style="color: #666;">This will display a "Most Popular" badge on this event type in the scheduler.</small>
        </p>
        <?php
    }

    public function save_event_type_meta( $post_id ) {
        if ( ! isset( $_POST['wpts_event_meta_nonce'] ) || ! wp_verify_nonce( $_POST['wpts_event_meta_nonce'], 'wpts_save_event_meta' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( 'event_type' !== get_post_type( $post_id ) ) {
            return;
        }

        if ( isset( $_POST['wpts_event_duration'] ) ) {
            update_post_meta( $post_id, '_event_duration', intval( $_POST['wpts_event_duration'] ) );
        }
        
        if ( isset( $_POST['wpts_event_team_id'] ) ) {
            $team_id = sanitize_text_field( $_POST['wpts_event_team_id'] );
            update_post_meta( $post_id, '_event_team_id', $team_id );
        }
        
        $teams_enabled = isset( $_POST['wpts_event_teams_enabled'] ) ? '1' : '0';
        update_post_meta( $post_id, '_event_teams_enabled', $teams_enabled );
        
        $is_popular = isset( $_POST['wpts_event_is_popular'] ) ? '1' : '0';
        update_post_meta( $post_id, '_event_is_popular', $is_popular );
    }
}