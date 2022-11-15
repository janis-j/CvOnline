function addIndex(type){
    let wrapperId = type === "Education: " ? "" : "1"
    jQuery(".dynamicform_wrapper"+wrapperId+" .panel-title-address").each(function(index) {
        jQuery(this).html(type + (index + 1))
    });
}
jQuery(".dynamicform_wrapper").on("afterInsert afterDelete", function(e, item) {
    addIndex("Education: ");
});
jQuery(".dynamicform_wrapper1").on("afterInsert afterDelete", function(e, item) {
    addIndex("Work experience: ");
});
