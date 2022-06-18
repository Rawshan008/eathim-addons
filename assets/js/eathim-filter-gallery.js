(function ($, elementor) {

  'use strict';
  var widgetFilteredGallery = function ($scope, $) {
    var $fiestar = $scope.find(".filter-eathim-gallery");
    if (!$fiestar.length) {
      return;
    }

    var $galleryContainer = $fiestar.find(".filter-gallery-content");
    var $settings = $fiestar.data('settings');
    var $filterMenu = $fiestar.find('.filter-gallery-filter');
  

    initGallery();
      async function initGallery() {
        await $galleryContainer.isotope($settings);
        await $galleryContainer.magnificPopup({
          delegate: '.filter-gallery-single-item', // child items selector, by clicking on it popup will open
          type: 'image',
          showCloseBtn: true,
          gallery:{
            enabled:true
          }
        });

        await $filterMenu.on("click", "button", function() {
          var filterValue = $(this).attr('data-filter');
          $galleryContainer.isotope({ filter: filterValue });
        });
    };

    

  };


  jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/eathim-addons-filter-gallery-widgets.default', widgetFilteredGallery);
  });

}(jQuery, window.elementorFrontend));