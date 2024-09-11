/**
 * Page-specific Javascript file.  Should generally be included as a separate asset bundle in your page template.
 * example: {{ assets.js('js/pages/sign-in-or-register') | raw }}
 *
 * This script depends on widgets/groups.js, uf-table.js, moment.js, handlebars-helpers.js
 *
 * Target page: /groups
 */

$(document).ready(function() {

    $("#widget-branches").ufTable({
        dataUrl: site.uri.public + "/api/branches",
        useLoadingTransition: site.uf_table.use_loading_transition
    });

    // Bind creation button
    bindBranchCreationButton($("#widget-branches"));

    //Bind table buttons
    bindBranchButtons($("#widget-branches"));

    //Bind table buttons
    bindAddRemoveButtons($("#widget-addremove"));
    
    // Bind table buttons
    //$("#widget-branches").on("pagerComplete.ufTable", function () {
        //bindBranchButtons($(this));
    //});
});
