$('#App_classique_libelleCat').change(function () {
    var catSelector = $(this);
    console.log(catSelector)
    // Request the neighborhoods of the selected city.
    $.ajax({
        url: "{{ path('person_list_neighborhoods') }}",
        type: "GET",
        dataType: "JSON",
        data: {
            libelleCat: catSelector.val()
        },
        success: function (sousCats) {
            var sousCatSelect = $("#App_classique_libelleSousCat");

            // Remove current options
            sousCatSelect.html('');

            // Empty value ...
            sousCatSelect.append('<option value> Select a sousCat of ' + catSelector.find("option:selected").text() + ' ...</option>');


            $.each(sousCats, function (key, sousCat) {
                sousCatSelect.append('<option value="' + sousCat.libelleSousCat + '">' + sousCat.libelleSousCat + '</option>');
            });
        },
        error: function (err) {
            alert("An error ocurred while loading data ...");
        }
    });
});
console.log($('.aaa'))