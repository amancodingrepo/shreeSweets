/**
 * Shree Sweets Global JavaScript Handling
 * Intercepts WooCommerce AJAX hooks for advanced UI/UX feedback
 */
jQuery(function($) {
    if (typeof wc_add_to_cart_params === 'undefined') return;

    /**
     * 1. Add-to-cart Loading State Hook
     */
    $(document).on('adding_to_cart', function(event, button, data) {
        if (button && button.length && typeof button.css === 'function') {
            // Apply loading spinner or text
            button.css('opacity', '0.6').css('pointer-events', 'none');
            var originalText = button.html();
            button.data('original-html', originalText);
            button.html('<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Adding...');
        }
    });

    /**
     * 2. Add-to-cart Success Feedback (Toast)
     */
    $(document).on('added_to_cart', function(event, fragments, cart_hash, button) {
        if (button && button.length && typeof button.css === 'function') {
            // Restore button
            button.css('opacity', '1').css('pointer-events', 'auto');
            if (typeof button.data === 'function' && button.data('original-html')) {
                button.html(button.data('original-html'));
            }
        }

        // Spawn custom toast notification
        if (typeof showToast === 'function') {
            showToast('Item successfully added to your cart!', 'success');
        }
    });

    /**
     * 3. Cart Amount Auto Update
     * Automatically update totals when qty inputs are changed natively
     */
    var cartUpdateTimeout;
    $(document).on('change', 'input.qty', function() {
        if ( cartUpdateTimeout !== undefined ) {
            clearTimeout( cartUpdateTimeout );
        }
        cartUpdateTimeout = setTimeout(function() {
            var updateButton = $('[name="update_cart"]');
            if (updateButton.length && typeof updateButton.trigger === 'function') {
                updateButton.trigger('click');
            }
        }, 500 );
    });

    /**
     * 4. Handle WooCommerce Events
     */
    $(document).on('added_to_cart updated_cart_totals wc_fragments_refreshed', function() {
        // Cart has been updated, fragments should refresh automatically
    });

    /**
     * Custom Toast Notification Function
     */
    function showToast(message, type = 'success') {
        var bgColor = type === 'success' ? '#27AE60' : '#E74C3C'; // brand-green / brand-red
        
        var toastHTML = '<div id="shreesweets-toast" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; background: ' + bgColor + '; color: white; padding: 12px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); font-size: 13px; font-weight: 600; opacity: 0; transform: translateY(10px); transition: all 0.3s ease;">' + message + '</div>';
        
        $('body').append(toastHTML);
        
        setTimeout(function() {
            $('#shreesweets-toast').css('opacity', '1').css('transform', 'translateY(0)');
        }, 10);
        
        setTimeout(function() {
            $('#shreesweets-toast').css('opacity', '0').css('transform', 'translateY(10px)');
            setTimeout(function() {
                $('#shreesweets-toast').remove();
            }, 300);
        }, 3000);
    }
});
