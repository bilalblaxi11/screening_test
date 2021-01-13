require('./bootstrap');
// Main Navigation
$( '.hamburger-menu' ).on( 'click', function() {
    $(this).toggleClass('open');
    $('.site-navigation').toggleClass('show');
});

$('.accordion-wrap .entry-title').on('click', function() {
    $('.accordion-wrap .entry-title').removeClass('active');
    $(this).addClass('active');
});
