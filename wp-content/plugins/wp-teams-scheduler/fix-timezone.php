<?php
/**
 * Quick Fix: Update Scheduler Base Timezone
 * Run this script once to fix the timezone setting
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if user is admin
if (!current_user_can('manage_options')) {
    die('Access denied. Admin privileges required.');
}

echo "<h2>WP Teams Scheduler - Timezone Fix</h2>";

// Get current settings
$general_settings = get_option('wpts_settings_general', []);

echo "<h3>Before Fix:</h3>";
echo "<p><strong>Current Base Timezone:</strong> " . ($general_settings['timezone'] ?? 'Not set (defaults to UTC)') . "</p>";

// Update the timezone setting
$general_settings['timezone'] = 'Asia/Kolkata';

// Save the updated settings
$updated = update_option('wpts_settings_general', $general_settings);

if ($updated) {
    echo "<h3>✅ Fix Applied Successfully!</h3>";
    echo "<p><strong>New Base Timezone:</strong> Asia/Kolkata</p>";
    echo "<p><strong>Your availability (9:00-17:00) will now be interpreted in India time.</strong></p>";
    
    echo "<h3>What This Means:</h3>";
    echo "<ul>";
    echo "<li>✅ Your availability will show exactly 9:00-17:00</li>";
    echo "<li>✅ No more timezone conversion issues</li>";
    echo "<li>✅ Users worldwide will see your business hours correctly</li>";
    echo "</ul>";
    
    echo "<h3>Next Steps:</h3>";
    echo "<ol>";
    echo "<li>Go to your scheduler page and test it</li>";
    echo "<li>You should now see 9:00-17:00 time slots</li>";
    echo "<li>Delete this file after confirming it works</li>";
    echo "</ol>";
    
    echo "<p><strong>Test your scheduler now:</strong> <a href='" . home_url() . "' target='_blank'>Visit your site</a></p>";
    
} else {
    echo "<h3>❌ Error: Could not update settings</h3>";
    echo "<p>Please try updating manually in WordPress Admin → Scheduler Settings → General</p>";
}

echo "<hr>";
echo "<p><small>This script can be deleted after use.</small></p>";
?> 