/**
 * Materialize init
 */
$( document ).ready(function() {
    // --> Navbar init
    $(".button-collapse").sideNav();
        // --> Dropdown init
        $(".dropdown-button").dropdown();

    // --> Form select init
    $('select').material_select();

    // -> Modal init
    $('.modal').modal();
});
