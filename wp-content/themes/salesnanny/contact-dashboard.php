<?php
/*
Template Name: Contact Dashboard
*/

// Start session for authentication
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is authenticated
$is_authenticated = isset($_SESSION['dashboard_authenticated']) && $_SESSION['dashboard_authenticated'] === true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Dashboard - Wise BI</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <!-- AJAX configuration for all scripts - Inline critical config -->
    <script>
    var ajax_object = {
        ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>",
        nonce: "<?php echo wp_create_nonce('enhanced_contact_form'); ?>",
        newsletter_nonce: "<?php echo wp_create_nonce('newsletter_subscription'); ?>",
        calendly_nonce: "<?php echo wp_create_nonce('calendly_tracker'); ?>",
        contactus_nonce: "<?php echo wp_create_nonce('contactus_form'); ?>",
        ebook_nonce: "<?php echo wp_create_nonce('ebook_download'); ?>"
    };
    </script>
    <style>
        :root {
            --primary-color: #1e90ff;
            --secondary-color: #2c3e50;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card, .dashboard-container { background: rgba(255, 255, 255, 0.95); border-radius: 20px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .dashboard-container { margin: 20px; padding: 30px; }
        .stats-card { border-radius: 15px; color: white; transition: transform 0.3s ease; }
        .stats-card:hover { transform: translateY(-5px); }
        .stats-card.total { background: linear-gradient(135deg, var(--info-color), #00d4ff); }
        .stats-card.unread { background: linear-gradient(135deg, var(--warning-color), #ff9a56); }
        .stats-card.today { background: linear-gradient(135deg, var(--success-color), #57ca85); }
        .stats-card.week { background: linear-gradient(135deg, var(--primary-color), #4facfe); }
        .btn-primary { background: linear-gradient(135deg, var(--primary-color), #4facfe); border: none; border-radius: 10px; transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); }
        .table { border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); }
        .table thead th { background: linear-gradient(135deg, var(--secondary-color), #34495e); color: white; border: none; font-weight: 600; }
        .badge { border-radius: 20px; padding: 8px 12px; }
        .status-unread { background: var(--warning-color); color: var(--dark-color); }
        .status-read { background: var(--success-color); color: white; }
        .form-control, .form-select { border-radius: 10px; border: 2px solid #e9ecef; transition: border-color 0.3s ease; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25); }
        .modal-content { border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); }
        .modal-header { background: linear-gradient(135deg, var(--primary-color), #4facfe); color: white; border-radius: 20px 20px 0 0; }
        .btn-close { filter: invert(1); }
        .loading { display: inline-block; width: 20px; height: 20px; border: 3px solid rgba(255, 255, 255, 0.3); border-radius: 50%; border-top-color: white; animation: spin 1s ease-in-out infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .alert { border-radius: 10px; border: none; }
        .expandable-content { max-height: 100px; overflow: hidden; transition: max-height 0.3s ease; }
        .expandable-content.expanded { max-height: 1000px; }
        .expand-btn { background: none; border: none; color: var(--primary-color); text-decoration: underline; padding: 0; font-size: 0.875rem; }
    </style>
</head>
<body>

<?php if (!$is_authenticated): ?>
    <!-- Login Form -->
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-card p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                            <h3 class="fw-bold">Dashboard Access</h3>
                            <p class="text-muted">Enter password to access the contact form dashboard</p>
                        </div>
                        
                        <form id="loginForm">
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Access Dashboard
                            </button>
                        </form>
                        
                        <div id="loginMessage" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <!-- Dashboard -->
    <div class="dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-0">
                    <i class="fas fa-tachometer-alt text-primary me-2"></i>
                    Contact Form Dashboard
                </h1>
                <p class="text-muted mb-0">Manage and analyze form submissions</p>
            </div>
            <div>
                <button class="btn btn-outline-primary me-2" onclick="exportCSV()">
                    <i class="fas fa-download me-2"></i>Export CSV
                </button>
                <button class="btn btn-outline-danger" onclick="logout()">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4" id="statsCards">
            <div class="col-md-3 mb-3">
                <div class="stats-card total p-4 text-center">
                    <i class="fas fa-envelope fa-2x mb-2"></i>
                    <h3 class="fw-bold mb-0" id="totalSubmissions">-</h3>
                    <p class="mb-0">Total Submissions</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card unread p-4 text-center">
                    <i class="fas fa-envelope-open fa-2x mb-2"></i>
                    <h3 class="fw-bold mb-0" id="unreadSubmissions">-</h3>
                    <p class="mb-0">Unread</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card today p-4 text-center">
                    <i class="fas fa-calendar-day fa-2x mb-2"></i>
                    <h3 class="fw-bold mb-0" id="todaySubmissions">-</h3>
                    <p class="mb-0">Today</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card week p-4 text-center">
                    <i class="fas fa-chart-line fa-2x mb-2"></i>
                    <h3 class="fw-bold mb-0" id="weekSubmissions">-</h3>
                    <p class="mb-0">This Week</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fas fa-filter me-2"></i>Filters & Search
                </h5>
                <!-- ======================================================================= -->
                <!-- START: UPDATED FILTER SECTION WITH TIME FIELDS -->
                <!-- ======================================================================= -->
                <div class="row g-2 align-items-end">
                    <div class="col-md-3 mb-3">
                        <label for="searchInput" class="form-label">Search</label>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by name, email, IP...">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="unread">Unread</option>
                            <option value="read">Read</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="typeFilter" class="form-label">Type</label>
                        <select class="form-select" id="typeFilter">
                            <option value="">All Types</option>
                            <option value="contact">Enhanced Contact</option>
                            <option value="contactus">Contact Form</option>
                            <option value="newsletter">Newsletter</option>
                            <option value="ebook">Ebook</option>
                            <option value="calendly">Calendly Clicks</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dateFrom" class="form-label">Date/Time From</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="dateFrom">
                            <input type="time" class="form-control" id="timeFrom"> <!-- NEW TIME FROM -->
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dateTo" class="form-label">Date/Time To</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="dateTo">
                            <input type="time" class="form-control" id="timeTo"> <!-- NEW TIME TO -->
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="perPage" class="form-label">Per Page</label>
                        <select class="form-select" id="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-md-1 mb-3">
                        <button class="btn btn-primary w-100" onclick="applyFilters()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- ======================================================================= -->
                <!-- END: UPDATED FILTER SECTION -->
                <!-- ======================================================================= -->
            </div>
        </div>

        <!-- Submissions Table -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-table me-2"></i>Form Submissions
                    </h5>
                    <div>
                        <button class="btn btn-outline-primary btn-sm me-2" onclick="refreshData()">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                
                <div id="loadingIndicator" class="text-center py-4" style="display: none;">
                    <div class="loading"></div>
                    <p class="mt-2">Loading submissions...</p>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="submissionsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Submission Time</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Type/Service</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="submissionsTableBody">
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Submissions pagination" class="mt-4">
                    <ul class="pagination justify-content-center" id="pagination">
                        <!-- Pagination will be generated here -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Submission Details Modal -->
    <div class="modal fade" id="submissionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-eye me-2"></i>Submission Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="submissionDetails">
                    <!-- Details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
// Global variables
let currentPage = 1;
let totalPages = 1;

$(document).ready(function() {
    <?php if ($is_authenticated): ?>
        loadSubmissions();
        loadStats();
        
        // Auto-refresh every 30 seconds
        setInterval(function() {
            loadSubmissions();
            loadStats();
        }, 30000);
    <?php endif; ?>
});

<?php if (!$is_authenticated): ?>
// Login functionality
$('#loginForm').on('submit', function(e) {
    e.preventDefault();
    
    const password = $('#password').val();
    const $submitBtn = $(this).find('button[type="submit"]');
    const $messageDiv = $('#loginMessage');
    
    $submitBtn.prop('disabled', true).html('<div class="loading me-2"></div>Authenticating...');
    
    $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
        data: {
            action: 'dashboard_authenticate',
            password: password
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $messageDiv.html('<div class="alert alert-success"><i class="fas fa-check me-2"></i>Access granted! Redirecting...</div>');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                $messageDiv.html('<div class="alert alert-danger"><i class="fas fa-times me-2"></i>' + (response.message || 'Invalid password') + '</div>');
            }
        },
        error: function() {
            $messageDiv.html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>An error occurred. Please try again.</div>');
        },
        complete: function() {
            $submitBtn.prop('disabled', false).html('<i class="fas fa-sign-in-alt me-2"></i>Access Dashboard');
        }
    });
});
<?php endif; ?>

<?php if ($is_authenticated): ?>
// Dashboard functionality
function loadSubmissions() {
    $('#loadingIndicator').show();
    
    // =======================================================================
    // START: UPDATED JS PARAMS WITH TIME FIELDS
    // =======================================================================
    const params = {
        action: 'dashboard_get_submissions',
        page: currentPage,
        per_page: $('#perPage').val() || 10,
        search: $('#searchInput').val(),
        status: $('#statusFilter').val(),
        type: $('#typeFilter').val(),
        date_from: $('#dateFrom').val(),
        date_to: $('#dateTo').val(),
        time_from: $('#timeFrom').val(), // <-- ADDED
        time_to: $('#timeTo').val()      // <-- ADDED
    };
    // =======================================================================
    // END: UPDATED JS PARAMS
    // =======================================================================
    
    $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'GET',
        data: params,
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert('Error: ' + response.error);
                return;
            }
            
            displaySubmissions(response.submissions);
            updatePagination(response.page, response.total_pages, response.total);
            totalPages = response.total_pages;
        },
        error: function(xhr, status, error) {
            console.error('Error loading submissions:', error);
            $('#submissionsTableBody').html('<tr><td colspan="8" class="text-center text-danger">Error loading submissions</td></tr>');
        },
        complete: function() {
            $('#loadingIndicator').hide();
        }
    });
}

function loadStats() {
    $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'GET',
        data: { action: 'dashboard_get_submissions', per_page: 9999 }, // Fetch all to calculate stats
        dataType: 'json',
        success: function(response) {
            if (response.submissions) {
                const submissions = response.submissions;
                const today = new Date().toISOString().split('T')[0];
                const weekAgo = new Date(Date.now() - 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];
                
                const unread = submissions.filter(s => s.status === 'unread').length;
                const todayCount = submissions.filter(s => s.submission_time.startsWith(today)).length;
                const weekCount = submissions.filter(s => s.submission_time >= weekAgo).length;
                
                $('#totalSubmissions').text(response.total);
                $('#unreadSubmissions').text(unread);
                $('#todaySubmissions').text(todayCount);
                $('#weekSubmissions').text(weekCount);
            }
        }
    });
}

function displaySubmissions(submissions) {
    const tbody = $('#submissionsTableBody');
    tbody.empty();
    
    if (submissions.length === 0) {
        tbody.html('<tr><td colspan="8" class="text-center text-muted">No submissions found for the selected filters.</td></tr>');
        return;
    }
    
    submissions.forEach(function(submission) {
        const formDetails = submission.form_details;
        const statusBadge = submission.status === 'unread' 
            ? '<span class="badge status-unread">Unread</span>' 
            : '<span class="badge status-read">Read</span>';
        
        let nameField, emailField, phoneField, lookingForField, submissionType;
        
        if (formDetails.action_type === 'ebook_download') {
            nameField = '-';
            emailField = escapeHtml(formDetails.email || '-');
            phoneField = '-';
            lookingForField = 'Brochure Download';
            submissionType = 'ebook';
        } else if (formDetails.subscription_type === 'newsletter') {
            nameField = '-';
            emailField = escapeHtml(formDetails.email || '-');
            phoneField = '-';
            lookingForField = 'Newsletter Subscription';
            submissionType = 'newsletter';
        } else if (formDetails.action_type === 'calendly_click') {
            nameField = '-';
            emailField = '-';
            phoneField = '-';
            lookingForField = 'Calendly Click';
            submissionType = 'calendly';
        } else if (formDetails.form_type === 'contactus') {
            nameField = escapeHtml((formDetails.first_name || '') + ' ' + (formDetails.last_name || ''));
            emailField = escapeHtml(formDetails.email || '-');
            phoneField = escapeHtml(formDetails.phone || '-');
            lookingForField = escapeHtml(formDetails.subject || 'Contact Form');
            submissionType = 'contactus';
        } else {
            nameField = escapeHtml(formDetails.full_name || '-');
            emailField = escapeHtml(formDetails.business_email || '-');
            phoneField = escapeHtml(formDetails.phone_number || '-');
            lookingForField = escapeHtml(formDetails.looking_for || '-');
            submissionType = 'contact';
        }
        
        let typeIndicator = '';
        switch(submissionType) {
            case 'newsletter': typeIndicator = '<i class="fas fa-newspaper text-info me-1" title="Newsletter"></i>'; break;
            case 'calendly': typeIndicator = '<i class="fas fa-calendar-alt text-warning me-1" title="Calendly Click"></i>'; break;
            case 'ebook': typeIndicator = '<i class="fas fa-book text-success me-1" title="Brochure Download"></i>'; break;
            case 'contactus': typeIndicator = '<i class="fas fa-envelope text-primary me-1" title="Contact Form"></i>'; break;
            default: typeIndicator = '<i class="fas fa-user text-secondary me-1" title="Enhanced Contact"></i>';
        }
        
        const row = `
            <tr class="${submission.status === 'unread' ? 'table-warning' : ''}">
                <td>#${submission.id}</td>
                <td>${formatDateTime(submission.submission_time)}</td>
                <td>${typeIndicator}${nameField}</td>
                <td>${emailField}</td>
                <td>${phoneField}</td>
                <td>${lookingForField}</td>
                <td>${statusBadge}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary" onclick="viewSubmission(${submission.id})" title="View Details"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-outline-${submission.status === 'unread' ? 'success' : 'warning'}" onclick="toggleStatus(${submission.id}, '${submission.status}')" title="Mark as ${submission.status === 'unread' ? 'Read' : 'Unread'}"><i class="fas fa-${submission.status === 'unread' ? 'check' : 'undo'}"></i></button>
                        <button class="btn btn-outline-danger" onclick="deleteSubmission(${submission.id})" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;
        tbody.append(row);
    });
}

function viewSubmission(id) {
    // This function fetches all submissions again to find the one to view.
    // For large datasets, a dedicated endpoint to fetch a single submission by ID would be more efficient.
    $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'GET',
        data: { action: 'dashboard_get_submissions', per_page: 9999 }, // Inefficient, but works for now.
        dataType: 'json',
        success: function(response) {
            const submission = response.submissions.find(s => s.id == id);
            if (submission) {
                // (Your existing viewSubmission logic for rendering the modal content)
                // This part remains unchanged as it just displays data.
                const formDetails = submission.form_details;
                const browserInfo = JSON.parse(submission.browser_info || '{}');
                
                let contactInfoSection = '';
                
                if (formDetails.action_type === 'ebook_download') {
                    contactInfoSection = `
                        <div class="col-md-6">
                            <h6><i class="fas fa-book me-2"></i>Brochure Download</h6>
                            <table class="table table-sm">
                                <tr><td><strong>Email:</strong></td><td>${escapeHtml(formDetails.email || '-')}</td></tr>
                                <tr><td><strong>Source Page:</strong></td><td><a href="${escapeHtml(formDetails.page_url || '-')}" target="_blank">${escapeHtml(formDetails.page_url || '-')}</a></td></tr>
                                ${formDetails.user_agent ? `<tr><td><strong>User Agent:</strong></td><td>${escapeHtml(formDetails.user_agent)}</td></tr>` : ''}
                                <tr><td><strong>Download Time:</strong></td><td>${formatDateTime(formDetails.timestamp || submission.submission_time)}</td></tr>
                            </table>
                        </div>
                    `;
                } else if (formDetails.subscription_type === 'newsletter') {
                    contactInfoSection = `
                        <div class="col-md-6">
                            <h6><i class="fas fa-newspaper me-2"></i>Newsletter Subscription</h6>
                            <table class="table table-sm">
                                <tr><td><strong>Email:</strong></td><td>${escapeHtml(formDetails.email || '-')}</td></tr>
                                <tr><td><strong>Type:</strong></td><td>Newsletter Subscription</td></tr>
                                <tr><td><strong>Source Page:</strong></td><td>${escapeHtml(formDetails.source_page || '-')}</td></tr>
                            </table>
                        </div>
                    `;
                } else if (formDetails.action_type === 'calendly_click') {
                    contactInfoSection = `
                        <div class="col-md-6">
                            <h6><i class="fas fa-calendar-alt me-2"></i>Calendly Click</h6>
                            <table class="table table-sm">
                                <tr><td><strong>Calendly URL:</strong></td><td><a href="${escapeHtml(formDetails.calendly_url || '-')}" target="_blank">${escapeHtml(formDetails.calendly_url || '-')}</a></td></tr>
                                <tr><td><strong>Source Page:</strong></td><td><a href="${escapeHtml(formDetails.source_page || '-')}" target="_blank">${escapeHtml(formDetails.source_page || '-')}</a></td></tr>
                                ${formDetails.referrer ? `<tr><td><strong>Referrer:</strong></td><td>${escapeHtml(formDetails.referrer)}</td></tr>` : ''}
                                ${formDetails.device_type ? `<tr><td><strong>Device Type:</strong></td><td>${escapeHtml(formDetails.device_type)}</td></tr>` : ''}
                                ${formDetails.screen_resolution ? `<tr><td><strong>Screen Resolution:</strong></td><td>${escapeHtml(formDetails.screen_resolution)}</td></tr>` : ''}
                                ${formDetails.language ? `<tr><td><strong>Language:</strong></td><td>${escapeHtml(formDetails.language)}</td></tr>` : ''}
                                <tr><td><strong>Click Time:</strong></td><td>${formatDateTime(formDetails.click_time || submission.submission_time)}</td></tr>
                            </table>
                        </div>
                    `;
                } else if (formDetails.form_type === 'contactus') {
                    contactInfoSection = `
                        <div class="col-md-6">
                            <h6><i class="fas fa-envelope me-2"></i>Contact Form Submission</h6>
                            <table class="table table-sm">
                                <tr><td><strong>Full Name:</strong></td><td>${escapeHtml((formDetails.first_name || '') + ' ' + (formDetails.last_name || ''))}</td></tr>
                                <tr><td><strong>Email:</strong></td><td>${escapeHtml(formDetails.email || '-')}</td></tr>
                                ${formDetails.phone ? `<tr><td><strong>Phone:</strong></td><td>${escapeHtml(formDetails.phone)}</td></tr>` : ''}
                                ${formDetails.subject ? `<tr><td><strong>Subject:</strong></td><td>${escapeHtml(formDetails.subject)}</td></tr>` : ''}
                                ${formDetails.message ? `<tr><td><strong>Message:</strong></td><td class="expandable-content" id="messageContent-${submission.id}">${escapeHtml(formDetails.message).replace(/\n/g, '<br>')}</td></tr>` : ''}
                            </table>
                            ${formDetails.message && formDetails.message.length > 100 ? `<button class="expand-btn" onclick="toggleExpand('messageContent-${submission.id}')">Show full message</button>` : ''}
                        </div>
                    `;
                } else {
                    // Default enhanced contact form
                    contactInfoSection = `
                        <div class="col-md-6">
                            <h6><i class="fas fa-user me-2"></i>Enhanced Contact Form</h6>
                            <table class="table table-sm">
                                <tr><td><strong>Name:</strong></td><td>${escapeHtml(formDetails.full_name || '-')}</td></tr>
                                <tr><td><strong>Email:</strong></td><td>${escapeHtml(formDetails.business_email || '-')}</td></tr>
                                <tr><td><strong>Phone:</strong></td><td>${escapeHtml(formDetails.phone_number || '-')}</td></tr>
                                <tr><td><strong>Looking For:</strong></td><td>${escapeHtml(formDetails.looking_for || '-')}</td></tr>
                                ${formDetails.message ? `<tr><td><strong>Message:</strong></td><td class="expandable-content" id="messageContent-${submission.id}">${escapeHtml(formDetails.message).replace(/\n/g, '<br>')}</td></tr>` : ''}
                            </table>
                            ${formDetails.message && formDetails.message.length > 100 ? `<button class="expand-btn" onclick="toggleExpand('messageContent-${submission.id}')">Show full message</button>` : ''}
                        </div>
                    `;
                }
                
                const details = `<div class="row">${contactInfoSection}<div class="col-md-6"><h6><i class="fas fa-info-circle me-2"></i>Submission Details</h6><table class="table table-sm"><tr><td><strong>Submission Time:</strong></td><td>${formatDateTime(submission.submission_time)}</td></tr><tr><td><strong>Page URL:</strong></td><td><a href="${submission.page_url}" target="_blank">${submission.page_url}</a></td></tr><tr><td><strong>IP Address:</strong></td><td>${submission.ip_address}</td></tr>${submission.location_info ? `<tr><td><strong>Location:</strong></td><td>${submission.location_info}</td></tr>` : ''}<tr><td><strong>Status:</strong></td><td><span class="badge ${submission.status === 'unread' ? 'status-unread' : 'status-read'}">${submission.status}</span></td></tr></table></div></div>${browserInfo.user_agent ? `<div class="mt-3"><h6><i class="fas fa-globe me-2"></i>Browser Information</h6><div class="expandable-content" id="browserInfo"><small class="text-muted">${escapeHtml(browserInfo.user_agent)}</small></div><button class="expand-btn mt-1" onclick="toggleExpand('browserInfo')">Show more</button></div>` : ''}`;
                
                $('#submissionDetails').html(details);
                new bootstrap.Modal(document.getElementById('submissionModal')).show();
                
                if (submission.status === 'unread') {
                    toggleStatus(id, 'unread');
                }
            }
        }
    });
}

function toggleStatus(id, currentStatus) {
    $.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
        data: { action: 'dashboard_update_status', id: id, status: (currentStatus === 'unread' ? 'read' : 'unread') },
        dataType: 'json',
        success: (response) => { if (response.success) { loadSubmissions(); loadStats(); } }
    });
}

function deleteSubmission(id) {
    if (confirm('Are you sure you want to delete this submission? This action cannot be undone.')) {
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: { action: 'dashboard_delete_submission', id: id },
            dataType: 'json',
            success: (response) => { if (response.success) { loadSubmissions(); loadStats(); } }
        });
    }
}

function exportCSV() {
    window.open('<?php echo admin_url('admin-ajax.php'); ?>?action=dashboard_export_csv', '_blank');
}

function applyFilters() {
    currentPage = 1;
    loadSubmissions();
}

function refreshData() {
    loadSubmissions();
    loadStats();
}

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: { action: 'dashboard_logout' },
            success: () => window.location.reload()
        });
    }
}

function updatePagination(page, totalPages, totalItems) {
    const pagination = $('#pagination');
    pagination.empty();
    if (totalPages <= 1) return;
    
    // Previous
    pagination.append(`<li class="page-item ${page === 1 ? 'disabled' : ''}"><a class="page-link" href="#" onclick="goToPage(${page - 1})">Previous</a></li>`);
    
    // Page numbers logic (simplified)
    for (let i = Math.max(1, page - 2); i <= Math.min(totalPages, page + 2); i++) {
        pagination.append(`<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" onclick="goToPage(${i})">${i}</a></li>`);
    }

    // Next
    pagination.append(`<li class="page-item ${page === totalPages ? 'disabled' : ''}"><a class="page-link" href="#" onclick="goToPage(${page + 1})">Next</a></li>`);
}

function goToPage(page) {
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    loadSubmissions();
}

function formatDateTime(dateTime) {
    return new Date(dateTime + 'Z').toLocaleString(undefined, {
        year: 'numeric', month: 'short', day: 'numeric', 
        hour: '2-digit', minute: '2-digit', hour12: true 
    });
}

function escapeHtml(text) {
    if (typeof text !== 'string') return '';
    return text.replace(/[&<>"']/g, (m) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'})[m]);
}

function toggleExpand(elementId) {
    const element = document.getElementById(elementId);
    element.classList.toggle('expanded');
    element.nextElementSibling.textContent = element.classList.contains('expanded') ? 'Show less' : 'Show more';
}

// Search input debounce
let searchTimeout;
$('#searchInput').on('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => applyFilters(), 500);
});

// =======================================================================
// START: UPDATED FILTER CHANGE HANDLER
// =======================================================================
$('#statusFilter, #typeFilter, #dateFrom, #dateTo, #timeFrom, #timeTo, #perPage').on('change', function() {
    applyFilters();
});
// =======================================================================
// END: UPDATED FILTER CHANGE HANDLER
// =======================================================================
<?php endif; ?>
</script>

</body>
</html>