(function ($) {
    "use strict";

    /*----------------------------------------------
        Sticky And Scroll Up
    ----------------------------------------------*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $(".header-sticky").removeClass("sticky-bar");
            $('#back-top').fadeOut(500);
        } else {
            $(".header-sticky").addClass("sticky-bar");
            $('#back-top').fadeIn(500);
        }
    });

    /*-----------------------------------
        slick Nav
    -----------------------------------*/
    var menu = $('ul#navigation');
    if(menu.length){
        menu.slicknav({
            prependTo: ".mobile_menu",
            closedSymbol: '+',
            openedSymbol:'-'
        });
    };

    /*-----------------------------------
        WOW active
    -----------------------------------*/
    new WOW().init();

    /*----------------------------------------------
       Documentation sidebar
    ----------------------------------------------*/
    $(document).on('click', '.close-sidebar, .sidebar-body-overlay', function() {
        $('.panel-sidebar-close, .panel-sidebar, .sidebar-body-overlay').removeClass('active');
    });
    $(document).on('click', '.sidebar-icon', function() {
        $('.panel-sidebar-close, .panel-sidebar, .sidebar-body-overlay').addClass('active');
    });

    /*----------------------------------------------
        Documentation Chick Menu
    ----------------------------------------------*/
    $(document).on('click', '.doc-list-wrapper .single-list .items', function() {
        $('.doc-list-wrapper .single-list .items').removeClass('selected');
        $(this).addClass('selected');
    });

    /*----------------------------------------------
        html2canvas
    ----------------------------------------------*/
    $('#bill-download').on('click', function () {
      var downloadSection = $('#download-section');
      var cWidth = downloadSection.width();
      var cHeight = downloadSection.height();
      var topLeftMargin = 0;
      var pdfWidth = cWidth + topLeftMargin * 2;
      var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
      var canvasImageWidth = cWidth;
      var canvasImageHeight = cHeight;
      var totalPDFPages = Math.ceil(cHeight / pdfHeight);

      html2canvas(downloadSection[0], { allowTaint: true }).then(function (
        canvas
      ) {
        var imgData = canvas.toDataURL('image/png', 1.0);
        var pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);

        for (var i = 0; i < totalPDFPages; i++) {
          if (i > 0) {
            pdf.addPage(pdfWidth, pdfHeight);
          }
          pdf.addImage(
            imgData,
            'PNG',
            topLeftMargin,
            -(pdfHeight * i) + topLeftMargin * 0,
            canvasImageWidth,
            canvasImageHeight
          );
        }
        pdf.save('marhabashopbd-bill.pdf');
      });
    });

}(jQuery));
