<?php
class WPTS_Jitsi_API {

    /**
     * Creates a unique Jitsi Meet URL.
     * Jitsi doesn't require authentication or a server call.
     * We just need to generate a unique room name.
     *
     * @param string $subject Not used by Jitsi, but kept for interface consistency.
     * @return string The Jitsi meeting URL.
     */
    public function create_jitsi_meeting($subject = '') {
        // Generate a reasonably unique room name to prevent collisions
        $room_name = 'WPScheduler-' . wp_generate_password(12, false);
        
        $meeting_url = 'https://meet.jit.si/' . $room_name;

        return $meeting_url;
    }
}