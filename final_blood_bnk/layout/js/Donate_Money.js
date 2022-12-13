var input_val=1
var button_val=0

$(".amount_buttons button").click(function(e){
    button_val = e.target.value;
    e.preventDefault();
    $(".test").attr("value",e.target.value)

})
$(".amount_input").keyup(function(){
$(".test").attr("value", $(".amount_input").val())
})

$(".sub_btn").click(function(e){
   if($(".test").val() == ""){
        e.preventDefault();
        toastr.error('خطأ ... من فضلك تاكد من اختيارك للمبلغ المراد التبرع به')
   }
})