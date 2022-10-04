/**
 * @file
 * Formation behaviors.
 */
(function (Drupal, $) {

  'use strict';

  Drupal.behaviors.formationTheme = {
    attach: function (context, settings) {
      once('nested-menu', '.region-primary-menu > .block-menu > .menu', context).forEach(
        function (element) {
          const $menuItems = $(element).find('.menu-item--expanded > a');
          $menuItems.click(function(event) {
            event.preventDefault();
            $menuItems.not(this).next().removeClass('opened');
            $(this).next().toggleClass('opened');
          })
        }
      )
    }
  };

} (Drupal, jQuery));
