/**
 * Created by jupassamani on 15-06-09.
 */
jQuery(document).ready(function(){
    jQuery("#pano_id").change(function(){
        var quest_id = jQuery("option:selected", this).attr("data-quest-id");
        jQuery("#quest_id").val(quest_id);
    });
});

jQuery("#category_id").change(function(){
    filter_words();
});

jQuery("#domain_id").change(function(){
    filter_words();
});

function filter_words()
{
    var cat_selected = jQuery( "#category_id option:selected" ).val();
    var dom_selected = jQuery( "#domain_id option:selected" ).val();

    jQuery(".cat_option").hide();
    jQuery("input:checkbox").hide();

    if(cat_selected == "NA" && dom_selected == "NA")
    {
        jQuery(".cat_option").show();
    }
    else if(cat_selected != "NA" && dom_selected == "NA")
    {
        jQuery(".cat_option").hide();
        jQuery(".cat" + cat_selected).show();
    }
    else if(cat_selected == "NA" && dom_selected != "NA")
    {
        jQuery(".cat_option").hide();
        jQuery(".dom" + dom_selected).show();
    }
    else
    {
        jQuery(".cat_option").hide();
        jQuery(".dom" + dom_selected + ".cat" + cat_selected).show();
    }
}