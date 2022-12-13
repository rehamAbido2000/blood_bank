
let Val;
let blood_type_id;
let blood_price;
let blood_amount;
//  For Get BloodTypes
let BloodTypes = [];
async function GetBloodTypes(){
    
    let Response = await fetch(`https:blood-bank.life/api/api/v1/blood_type/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        BloodTypes =  results.data;
        displayBloodType();  
    } 
    
}

function displayBloodType(){

     let AllBloodTypes = document.querySelector('#blood_type-z');
     let blood=``;
     for (let i = 0 ; i < BloodTypes.length ; i++) {

         blood += `

         <option value="${BloodTypes[i].id}">${BloodTypes[i].name}</option>

            `
     }
                
    //  let x = `<option selected disabled value=""> ... اختر فصيلة الدم </option>`
     AllBloodTypes.innerHTML = blood ;

}
 
 GetBloodTypes();

//  To Get Id About Blood Type
 let AllBloodTypes = document.querySelector('#blood_type-z');
 AllBloodTypes.onchange = ()=>{
    
    let sel_value = AllBloodTypes.options[AllBloodTypes.selectedIndex].value;
    blood_type_id = sel_value;
    GetAvailableBlood();

}

/********************** Start To Gether ***********************/
//  For Get AvailableBlood
 let AvailableBlood = [];
 async function GetAvailableBlood(){
    
     let Response = await fetch(`https:blood-bank.life/api/api/v1/avilable_blood/530504012422/all`);
     if(Response.ok && Response.status != 400){
         let results = await Response.json();
         AvailableBlood =  results.data;

         DisplayBloodPrice();  
     } 
    
 }
//  Function Display Blood Price
 function DisplayBloodPrice(){

     for (let i = 0; i < AvailableBlood.length; i++) {
         if(blood_type_id == AvailableBlood[i].blood_type_id){

            if(AvailableBlood[i].price){
                document.querySelector('#priceOfBlood').setAttribute('value',`جنية ${AvailableBlood[i].price}`);
            }
            else{
                document.querySelector('#priceOfBlood').setAttribute('value',`لا يتوفر سعر لهذه الفصيلة`);
            }
            
             blood_price = AvailableBlood[i].price;
             blood_amount = AvailableBlood[i].amount;
         }

     }

 }
/********************** End To Gether ***********************/


//  To Calc the Total Price of Blood Bags
let blood_bags_num = document.querySelector('#blood_bags_num');
blood_bags_num.onchange = ()=>{
   
   let sel_value = blood_bags_num.options[blood_bags_num.selectedIndex].value;
   Val = sel_value

   document.querySelector('#totalPriceOfBlood').setAttribute('value',`جنية ${blood_price * Val}`);
}



$(document).ready(function(){
    $('.ui.modal')
    .modal('show')
  ;
})

$(document).ready(function(){

    $('.ui.dropdown')

    .dropdown()

  ;
});