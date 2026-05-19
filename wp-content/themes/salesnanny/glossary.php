<?php
/**
 * Template Name: Glossary Page
 */
get_header();

$glossary_terms = array(
    array(
        'term' => 'API Integration',
        'definition' => 'API integration connects your CRM, ERP, and logistics systems so customer, order, and shipping data moves automatically without manual updates.',
    ),
    array(
        'term' => 'Automated Follow-Up',
        'definition' => 'Automated follow-up is a rule-based sequence of emails, reminders, or tasks sent after a lead action to keep opportunities active.',
    ),
    array(
        'term' => 'Backorder',
        'definition' => 'A backorder is a customer order accepted for an item that is temporarily out of stock and fulfilled once inventory is replenished.',
    ),
    array(
        'term' => 'Carrier Performance',
        'definition' => 'Carrier performance measures how consistently logistics partners deliver shipments on time, in full, and without damage.',
    ),
    array(
        'term' => 'Churn Rate',
        'definition' => 'Churn rate is the percentage of customers who stop buying or cancel service during a specific period.',
    ),
    array(
        'term' => 'Conversion Rate',
        'definition' => 'Conversion rate is the percentage of qualified leads that become paying customers after engaging with your sales process.',
    ),
    array(
        'term' => 'Customer Lifetime Value (CLV)',
        'definition' => 'CLV estimates the total revenue a customer is expected to generate throughout the business relationship.',
    ),
    array(
        'term' => 'Demand Forecasting',
        'definition' => 'Demand forecasting projects future product demand using historical sales, seasonality, and market signals to guide planning.',
    ),
    array(
        'term' => 'Fulfillment Lead Time',
        'definition' => 'Fulfillment lead time is the total duration from order confirmation to final shipment dispatch.',
    ),
    array(
        'term' => 'Gross Margin',
        'definition' => 'Gross margin is revenue minus cost of goods sold, shown as a value or percentage to indicate product profitability.',
    ),
    array(
        'term' => 'Inventory Turnover',
        'definition' => 'Inventory turnover indicates how frequently stock is sold and replaced in a period, reflecting demand and stock efficiency.',
    ),
    array(
        'term' => 'Key Account Management',
        'definition' => 'Key account management is a strategic approach to growing high-value customer relationships through tailored engagement plans.',
    ),
    array(
        'term' => 'Lead Qualification',
        'definition' => 'Lead qualification is the process of evaluating prospect fit, intent, and buying capacity before assigning sales resources.',
    ),
    array(
        'term' => 'On-Time Delivery (OTD)',
        'definition' => 'OTD tracks the percentage of orders delivered on or before the promised date.',
    ),
    array(
        'term' => 'Opportunity Pipeline',
        'definition' => 'The opportunity pipeline is the set of active deals across sales stages, used to forecast likely revenue.',
    ),
    array(
        'term' => 'Order Accuracy',
        'definition' => 'Order accuracy measures how often items, quantities, and shipping details match what the customer requested.',
    ),
    array(
        'term' => 'Procurement Cycle',
        'definition' => 'The procurement cycle covers each step from identifying a purchasing need to supplier payment and delivery verification.',
    ),
    array(
        'term' => 'Quota Attainment',
        'definition' => 'Quota attainment is the percentage of target revenue or volume achieved by an individual salesperson or team.',
    ),
    array(
        'term' => 'Return on Investment (ROI)',
        'definition' => 'ROI compares net gain from an initiative against its total cost to measure financial effectiveness.',
    ),
    array(
        'term' => 'Sales Velocity',
        'definition' => 'Sales velocity estimates how quickly revenue moves through your pipeline based on deal size, win rate, and cycle length.',
    ),
    array(
        'term' => 'Safety Stock',
        'definition' => 'Safety stock is extra inventory held to absorb demand spikes or supplier delays and prevent stockouts.',
    ),
    array(
        'term' => 'SKU Rationalization',
        'definition' => 'SKU rationalization is the process of reducing low-performing product variations to simplify operations and improve margins.',
    ),
    array(
        'term' => 'Supply Chain Visibility',
        'definition' => 'Supply chain visibility is real-time access to inventory, orders, and transit status across suppliers, warehouses, and delivery networks.',
    ),
    array(
        'term' => 'Win Rate',
        'definition' => 'Win rate is the percentage of qualified opportunities that close successfully within a given period.',
    ),
);

usort(
    $glossary_terms,
    static function ( $a, $b ) {
        return strcasecmp( $a['term'], $b['term'] );
    }
);

$letters = array();
foreach ( $glossary_terms as $item ) {
    $letter = strtoupper( substr( $item['term'], 0, 1 ) );
    $letters[ $letter ] = true;
}
?>

<section class="sn-glossary-page">
    <div class="sn-glossary-wrap">
        <header class="sn-glossary-hero">
            <p class="sn-glossary-eyebrow">SalesNanny Resource Center</p>
            <h1>Business &amp; Supply Chain Glossary</h1>
            <p>
                Explore clear definitions for essential sales, operations, and logistics terms.
                Use search or jump by letter to find concepts quickly.
            </p>
        </header>

        <div class="sn-glossary-tools">
            <label for="snGlossarySearch" class="screen-reader-text">Search glossary terms</label>
            <input type="search" id="snGlossarySearch" placeholder="Search by term or keyword" aria-label="Search glossary terms">
            <div class="sn-glossary-index" role="tablist" aria-label="Glossary index">
                <button type="button" class="is-active" data-letter="all">All</button>
                <?php foreach ( array_keys( $letters ) as $letter ) : ?>
                    <button type="button" data-letter="<?php echo esc_attr( $letter ); ?>"><?php echo esc_html( $letter ); ?></button>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="snGlossaryList" class="sn-glossary-grid">
            <?php foreach ( $glossary_terms as $item ) : ?>
                <?php $letter = strtoupper( substr( $item['term'], 0, 1 ) ); ?>
                <article class="sn-glossary-card" data-letter="<?php echo esc_attr( $letter ); ?>" data-search="<?php echo esc_attr( strtolower( $item['term'] . ' ' . $item['definition'] ) ); ?>">
                    <h2><?php echo esc_html( $item['term'] ); ?></h2>
                    <p><?php echo esc_html( $item['definition'] ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <p id="snGlossaryEmpty" class="sn-glossary-empty" hidden>No matching glossary terms found.</p>
    </div>
</section>

<style>
.sn-glossary-page { background: #f4f6fb; padding: 54px 16px 68px; margin-top: 100px;}
.sn-glossary-wrap { max-width: 1140px; margin: 0 auto; }
.sn-glossary-hero { background: linear-gradient(135deg, #1f2460 0%, #2d368f 100%); color: #fff; border-radius: 20px; padding: 36px; box-shadow: 0 16px 40px rgba(18, 29, 72, 0.2);margin-top: 100px; }
.sn-glossary-eyebrow { margin: 0 0 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 1.2px; color: #b8c4ff; }
.sn-glossary-hero h1 { margin: 0 0 12px; font-size: clamp(28px, 4vw, 42px); line-height: 1.15; color: #fff; }
.sn-glossary-hero p { margin: 0; font-size: 17px; line-height: 1.65; color: #e7ecff; max-width: 760px; }

.sn-glossary-tools { display: grid; gap: 14px; margin: 30px 0 20px; }
#snGlossarySearch { width: 100%; border: 1px solid #c9d0e5; border-radius: 12px; padding: 14px 16px; font-size: 16px; background: #fff; color: #172041; }
#snGlossarySearch:focus { outline: 0; border-color: #2f61e8; box-shadow: 0 0 0 3px rgba(47, 97, 232, 0.15); }

.sn-glossary-index { display: flex; gap: 8px; flex-wrap: wrap; }
.sn-glossary-index button { border: 1px solid #c9d0e5; background: #fff; color: #233066; font-size: 14px; line-height: 1; border-radius: 999px; padding: 9px 13px; cursor: pointer; transition: all 0.2s ease; }
.sn-glossary-index button:hover { border-color: #2f61e8; color: #2f61e8; }
.sn-glossary-index button.is-active { background: #2f61e8; border-color: #2f61e8; color: #fff; }

.sn-glossary-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
.sn-glossary-card { background: #fff; border: 1px solid #d7dded; border-radius: 16px; padding: 20px; box-shadow: 0 4px 14px rgba(30, 42, 87, 0.06); }
.sn-glossary-card h2 { margin: 0 0 10px; font-size: 20px; color: #1a2450; line-height: 1.35; }
.sn-glossary-card p { margin: 0; font-size: 15px; line-height: 1.7; color: #37416f; }

.sn-glossary-empty { margin: 22px 0 0; text-align: center; color: #5f6893; font-size: 15px; }

@media (max-width: 900px) {
    .sn-glossary-grid { grid-template-columns: 1fr; }
}

@media (max-width: 600px) {
    .sn-glossary-page { padding: 36px 14px 46px; }
    .sn-glossary-hero { padding: 24px; border-radius: 14px; }
    .sn-glossary-hero p { font-size: 15px; }
    #snGlossarySearch { font-size: 15px; }
}
</style>

<script>
(function () {
    var searchInput = document.getElementById('snGlossarySearch');
    var indexButtons = document.querySelectorAll('.sn-glossary-index button');
    var cards = document.querySelectorAll('.sn-glossary-card');
    var emptyState = document.getElementById('snGlossaryEmpty');
    var activeLetter = 'all';

    function applyFilters() {
        var query = (searchInput.value || '').trim().toLowerCase();
        var visibleCount = 0;

        cards.forEach(function (card) {
            var matchesLetter = activeLetter === 'all' || card.dataset.letter === activeLetter;
            var matchesSearch = !query || card.dataset.search.indexOf(query) !== -1;
            var isVisible = matchesLetter && matchesSearch;
            card.hidden = !isVisible;
            if (isVisible) {
                visibleCount += 1;
            }
        });

        emptyState.hidden = visibleCount !== 0;
    }

    indexButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            activeLetter = button.getAttribute('data-letter');
            indexButtons.forEach(function (btn) { btn.classList.remove('is-active'); });
            button.classList.add('is-active');
            applyFilters();
        });
    });

    searchInput.addEventListener('input', applyFilters);
    applyFilters();
})();
</script>

<?php get_footer(); ?>