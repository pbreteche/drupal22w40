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
          const menuItems = element.querySelectorAll('.menu-item--expanded > a');
          for (const menuItem of menuItems) {
            menuItem.addEventListener('click', function(event) {
              event.preventDefault();
              for (const otherItem of menuItems) {
                if (otherItem === menuItem) {
                  continue;
                }
                otherItem.nextElementSibling.classList.remove('opened');
              }
              menuItem.nextElementSibling.classList.toggle('opened');
            })
          }
        }
      )
    }
  };

} (Drupal, jQuery));
