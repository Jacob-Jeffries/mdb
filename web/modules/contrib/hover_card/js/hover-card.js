/**
 * @file
 * Attaches the behaviors for the Hover Card module.
 */

(function ($, Drupal) {
  'use strict'

  /**
   * Generates & displays the required values for the Hover Card.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.hoverCard = {
    attach: function (context, settings) {
      // Declaring the const 'hoverUserDetails', it holds the initiating HTML
      // tag useful for the Hovercard JS plugin.
      const hoverUserDetails = '<div class="hover-details"></div>'
      // Targeting 'hovercard' function for all anchor tags with 'username' as
      // their class or anchor tags belonging to rel="schema:author".
      $('a.username, span[rel="schema:author"] > a', context).hovercard({
        detailsHTML: hoverUserDetails,
        width: 250,
        onHoverIn: function () {
          // Declaring basePath as const for further use in image path.
          const basePath = settings.path.baseUrl
          // Declaring modulePath as const for Hover Card module path which is
          // required for fetching the loader image path from the Hover Card
          // module directory.
          const modulePath = settings.path.hoverCard
          // Declaring this as a const for efficiency as its used multiple
          // times.
          const hoverDetails = $('.hover-details', context)
          const userLink = $(this).find('a').attr('href')
          // We'll store the User ID in this const.
          const userID = userLink.replace(basePath, '/').split('/')
          // This won't work if accessing site via. //localhost/sitename
          $.ajax({
            url: basePath + 'hover-card/' + userID[2],
            beforeSend: function () {
              hoverDetails.empty()
              hoverDetails.prepend('<p style="text-align: center"><img alt="Hover Card Loader" src="' + basePath + modulePath + '/images/ajax-loader.gif" /></p>')
            },
            success: function (data) {
              hoverDetails.html(data)
            },
            complete: function () {
              $('.loading-text', context).remove()
            },
          })
        },
      })
    },
  }
})(jQuery, Drupal)
