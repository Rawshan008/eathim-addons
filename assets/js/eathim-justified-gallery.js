(function ($, elementor) {

  'use strict';
  var widgetJustifiedGallery = function ($scope, $) {
    var $fiestar = $scope.find(".eathim-gallery");
    if (!$fiestar.length) {
      return;
    }

    var $galleryContainer = $fiestar.find(".gallery-content");
    var $settings = $fiestar.data('settings');
  

    initGallery();
      async function initGallery() {
        await $galleryContainer.justifiedGallery($settings);
        await $galleryContainer.magnificPopup({
          delegate: '.gallery-single-item', // child items selector, by clicking on it popup will open
          type: 'image',
          showCloseBtn: true,
          gallery:{
            enabled:true
          }
        });
    };

  };


  jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/eathim-addons-justified-gallery-widgets.default', widgetJustifiedGallery);
  });

}(jQuery, window.elementorFrontend));