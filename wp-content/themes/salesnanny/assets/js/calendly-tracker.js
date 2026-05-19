/**
 * Calendly Click Tracking Script
 * Simplified and reliable tracking for Wise BI
 */

// Prevent multiple initializations
if (!window.calendlyTrackingInitialized) {
  window.calendlyTrackingInitialized = true;

  // Function to send tracking data to WordPress
  function sendTrackingData(data) {
    // Use WordPress AJAX endpoint - ensure ajax_object is available
    const ajaxUrl = (typeof ajax_object !== 'undefined' && ajax_object.ajax_url) ? ajax_object.ajax_url : '/wp-admin/admin-ajax.php';
    
    // Create form data
    const formData = new FormData();
    formData.append('action', 'track_calendly_click');
    
    // Add nonce if available
    if (typeof ajax_object !== 'undefined' && ajax_object.calendly_nonce) {
      formData.append('nonce', ajax_object.calendly_nonce);
    } else if (typeof ajax_object !== 'undefined' && ajax_object.nonce) {
      formData.append('nonce', ajax_object.nonce);
    }
    
    // Add all tracking data
    Object.keys(data).forEach(key => {
      formData.append(key, data[key]);
    });
    
    fetch(ajaxUrl, {
      method: "POST",
      body: formData
    })
    .then(response => response.text())
    .then(text => {
      try {
        JSON.parse(text); // Validate JSON response
      } catch (e) {
        // Silently handle non-JSON responses
      }
    })
    .catch(err => {
      // Silently handle errors in production
    });
  }

  // Function to get basic visitor information (no external API calls)
  function getVisitorInfo() {
    return {
      page_url: window.location.href,
      referrer: document.referrer || "Direct visit",
      user_agent: navigator.userAgent,
      screen_resolution: `${screen.width}x${screen.height}`,
      language: navigator.language,
      device_type: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? 'Mobile' : 'Desktop',
      timestamp: new Date().toISOString(),
      security: (typeof ajax_object !== 'undefined' && ajax_object.nonce) ? ajax_object.nonce : ''
    };
  }

  // Track Calendly button clicks
  function trackCalendlyClick(button) {
    const visitorInfo = getVisitorInfo();
    
    const trackingData = {
      event_type: 'calendly_click',
      calendly_url: button.href,
      current_page: visitorInfo.page_url,
      referrer: visitorInfo.referrer,
      user_agent: visitorInfo.user_agent,
      screen_resolution: visitorInfo.screen_resolution,
      language: visitorInfo.language,
      device_type: visitorInfo.device_type,
      timestamp: visitorInfo.timestamp
    };

    sendTrackingData(trackingData);
  }

  // Check if link is a Calendly link
  function isCalendlyLink(url) {
    return url && (url.includes('online-meeting'));
  }

  // Handle clicks on Calendly links
  function handleCalendlyClick(e) {
    const link = e.target.closest('a'); // Get the anchor element even if clicked on child element
    
    if (link && isCalendlyLink(link.href)) {
      // Prevent duplicate tracking by checking if this link was already tracked recently
      const now = Date.now();
      const linkKey = link.href;
      
      if (window.calendlyTrackedLinks && window.calendlyTrackedLinks[linkKey]) {
        const lastTracked = window.calendlyTrackedLinks[linkKey];
        // Ignore if tracked within the last 2 seconds (prevents duplicates)
        if (now - lastTracked < 2000) {
          return;
        }
      }
      
      // Initialize tracking cache if not exists
      if (!window.calendlyTrackedLinks) {
        window.calendlyTrackedLinks = {};
      }
      
      // Mark this link as tracked
      window.calendlyTrackedLinks[linkKey] = now;
      
      trackCalendlyClick(link);
    }
  }

  // Initialize tracking when page loads
  function initializeTracking() {
    // Track all existing Calendly links
    const calendlyLinks = document.querySelectorAll('a[href*="online-meeting"]');
    
    // Use only document-level event delegation to prevent duplicates
    document.removeEventListener("click", handleCalendlyClick);
    document.addEventListener("click", handleCalendlyClick);
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener("DOMContentLoaded", initializeTracking);
  } else {
    // DOM is already ready
    initializeTracking();
  }

  // Also try to initialize after a short delay to catch any dynamically loaded content
//   setTimeout(initializeTracking, 1000);

  // Export for manual tracking if needed
  window.trackCalendlyClick = trackCalendlyClick;
  window.getVisitorInfo = getVisitorInfo;
} 