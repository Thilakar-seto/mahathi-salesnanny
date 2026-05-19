<?php
/**
 * Debug script to check timezone settings
 * Access this file directly in your browser to see current settings
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if user is admin
if (!current_user_can('manage_options')) {
    die('Access denied. Admin privileges required.');
}

echo "<h2>WP Teams Scheduler - Timezone Debug</h2>";

// Get scheduler settings
$general_settings = get_option('wpts_settings_general');

echo "<h3>Current Settings:</h3>";
echo "<ul>";
echo "<li><strong>Base Timezone:</strong> " . ($general_settings['timezone'] ?? 'Not set (defaults to UTC)') . "</li>";
echo "<li><strong>Buffer Time:</strong> " . ($general_settings['buffer_time'] ?? '0') . " minutes</li>";
echo "</ul>";

echo "<h3>Availability Settings:</h3>";
$availability = $general_settings['availability'] ?? [];
if (empty($availability)) {
    echo "<p>No availability settings configured.</p>";
} else {
    echo "<ul>";
    foreach ($availability as $day => $settings) {
        if (isset($settings['enabled']) && $settings['enabled']) {
            echo "<li><strong>" . ucfirst($day) . ":</strong> " . 
                 ($settings['start'] ?? 'Not set') . " to " . 
                 ($settings['end'] ?? 'Not set') . "</li>";
        }
    }
    echo "</ul>";
}

echo "<h3>Timezone Conversion Test:</h3>";
$base_tz = $general_settings['timezone'] ?? 'UTC';
$user_tz = 'Asia/Kolkata'; // Example user timezone

echo "<p><strong>Base Timezone:</strong> $base_tz</p>";
echo "<p><strong>Example User Timezone:</strong> $user_tz</p>";

// Test conversion
$test_date = '2025-01-16';
$test_start = '09:00';
$test_end = '17:00';

$base_timezone = new DateTimeZone($base_tz);
$user_timezone = new DateTimeZone($user_tz);

$day_start_base = new DateTime($test_date . ' ' . $test_start, $base_timezone);
$day_end_base = new DateTime($test_date . ' ' . $test_end, $base_timezone);

$day_start_user = clone $day_start_base;
$day_start_user->setTimezone($user_timezone);

$day_end_user = clone $day_end_base;
$day_end_user->setTimezone($user_timezone);

echo "<p><strong>Base Timezone Times:</strong> " . $day_start_base->format('H:i') . " - " . $day_end_base->format('H:i') . "</p>";
echo "<p><strong>User Timezone Times:</strong> " . $day_start_user->format('H:i') . " - " . $day_end_user->format('H:i') . "</p>";

echo "<h3>Solution:</h3>";
echo "<p>To fix the time slot issue, you need to:</p>";
echo "<ol>";
echo "<li>Go to WordPress Admin → Scheduler Settings → General</li>";
echo "<li>Set the 'Base Timezone' to match your local timezone (e.g., Asia/Kolkata for India)</li>";
echo "<li>Save the settings</li>";
echo "<li>Your availability hours (9:00-17:00) will now be interpreted in your local timezone</li>";
echo "</ol>";

echo "<p><strong>Current WordPress Timezone:</strong> " . wp_timezone_string() . "</p>";
echo "<p><strong>Current Server Timezone:</strong> " . date_default_timezone_get() . "</p>";
?> 