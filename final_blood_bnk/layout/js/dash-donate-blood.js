
let  Val;
let gov_id;
let city_id;
let place_id;

let val_gov;
let val_city;
let place_name_x;
let user_blood_type;
let date;

// For Get Cities And Gov
let Govs = [];
async function GetGov(){

    let Response = await fetch(`https://blood-bank.life/api/api/v1/governorate/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Govs =  results.data;
        d_Gov_data();
    } 
}
function d_Gov_data(){

    let All_Gov = document.querySelector('#Gov_x');
    let gov=``;
    for (let i = 0 ; i < Govs.length ; i++) {

            gov += `

                <option data_id=${Govs[i].id} value="${Govs[i].name}">${Govs[i].name}</option>
            
            `
    }
    All_Gov.innerHTML = gov;

}
GetGov();

// To Get  Cities that belongs to Gov From Datalist
document.querySelector('#gov').addEventListener('keyup', function(e) {
    let input = e.target,
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        inputValue = input.value;

    for(let i = 0; i < options.length; i++) {
        let option = options[i];

        if(option.innerText === inputValue) {
            val_gov = inputValue;
            gov_id = option.getAttribute('data_id');
            break;
        }
    }
    GetCities();

});

// For Get Cities
let AllCities = [];
async function GetCities(){

    let Response = await fetch(`https://blood-bank.life/api/api/v1/cities/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        AllCities =  results.data;

        d_Cities_data();
    } 
}
function d_Cities_data(){

    let All_Cities = document.querySelector('#City_x');
    let cities=``;
    for (let i = 0 ; i < AllCities.length ; i++) {
        if(gov_id == AllCities[i].gov_id){

            // I need to show api to check city_id is true syntax or not
            cities += `
    
                <option data_id=${AllCities[i].id} value="${AllCities[i].name}">${AllCities[i].name}</option>
            
            `
        }

    }
    if(cities == ''){
        All_Cities.innerHTML = `<option  value="لا يوجد مدن">لا يوجد مدن</option>`
      }
      else{
        All_Cities.innerHTML = cities;
      }
}
// End

// To Get  Places that belongs to Cities From Datalist
document.querySelector('#city').addEventListener('keyup', function(e) {
    let input = e.target,
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        inputValue = input.value;

    for(let i = 0; i < options.length; i++) {
        let option = options[i];

        if(option.innerText === inputValue) {
            val_city = inputValue;
            city_id = option.getAttribute('data_id');
           
            break;
        }
    }
    GetHospitals();

});
// For Get Hospitals belongs to specific City
let Hosp = [];
async function GetHospitals(){

    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_donate_places_info/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Hosp =  results.data;
        d_Hospital_data();
    } 
}
function d_Hospital_data(){

  let All_Hospital = document.querySelector('#donate_place_x');
  let hospital=``;
  for (let i = 0 ; i < Hosp.length ; i++) {
      if(city_id == Hosp[i].city_id){
          hospital += `
          <option data_id = "${Hosp[i].id}"  value="${Hosp[i].place_name}"> ${Hosp[i].place_name} </option>
        `
      }
  }
  if(hospital == ''){
    All_Hospital.innerHTML = `<option  value="لا يوجد مستشفيات">لا يوجد مستشفيات</option>`
  }
  else{
    All_Hospital.innerHTML = hospital;
  }

}
// End

// To Get  Places that belongs to Cities From Datalist
document.querySelector('#placeId').addEventListener('keyup', function(e) {
    let input = e.target,
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        inputValue = input.value;
        place_name_x = inputValue;

    for(let i = 0; i < options.length; i++) {
        let option = options[i];

        if(option.innerText.trim() === inputValue) {

            place_id = option.getAttribute('data_id');
            break;
        }

    }

});



let P_ssn = document.querySelector('#ssn').value;
let city = document.querySelector('#city');
let Donate_place = document.querySelector('#Donate_place');
let donate_time = document.querySelector('#donate_time');
donate_time.onchange = ()=>{
    date = donate_time.value
}

// For Get user Blood Type
let users = [];
async function Users(){
    
    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_patients_donners_info/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        users=  results.data;
        d_user_data();
    } 
}
function d_user_data(){
    let blood_ty = document.querySelector('#bloodType');
    
    for (let i = 0 ; i < users.length ; i++) {
        if(P_ssn == users[i].p_ssn){
            
            user_blood_type = users[i].blood_type
            blood_ty.setAttribute('value',`${users[i].blood_type}`)
            
        }
        
    }
}
Users();


// For Get donatePlaces
let donatePlaces = [];
async function donate_Places(){
    
    let Response = await fetch(`https://blood-bank.life/api/api/v1/donate_places/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        donatePlaces=  results.data;
    } 
}
donate_Places();  

/*******************************  Start Add *******************************/
// function to book appointment to donate 
async function book_appointment_to_donate() {
    const days = ['الأحد', 'الأتنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعه', 'السبت'];
    date = donate_time.value
    let d = new Date(donate_time.value);
    let dayName = days[d.getDay()];

    for (let i = 0 ; i < donatePlaces.length ; i++) {

        if(place_name_x == donatePlaces[i].place_name){

            if (dayName == donatePlaces[i].holiday) {
                
                document.querySelector('#donate_msg').innerHTML = `  حدد يوم اخر لأن اليوم الذى اخترته من الأيام التى يكون فيها المكان اجازة مع العلم ان ايام الأجازة هى ${donatePlaces[i].holiday} `;
                
            } else {
                
                let open = donatePlaces[i].open_at;
                let close = donatePlaces[i].close_at;
            
                document.querySelector('#donate_msg').innerHTML = `   لقد تم حجز الموعد بنجاح مع العلم ان المكان يتم فتحه من الساعة ${open.split(':')[0]} ص الى الساعة   ${close.split(':')[0] - 12} م   `;
                
                let user_Data = {    
                    p_ssn:P_ssn,
                    city_id:city_id,
                    donate_place_id:place_id,
                    time:date
            
                }    
                let Response = await fetch(`https://blood-bank.life/api/api/v1/blood_donation/530504012422/add`,
                {
                    method:'POST',
                    headers:{'Content-Type':'application/json'}, //mean that interact with json 
                    mode:'no-cors',
                    body:JSON.stringify(user_Data)
                }
                );
                let finalRe = await Response.json();   
            }
        }  
    }

    if(place_name_x == 'لا يوجد مستشفيات'){
        document.querySelector('#donate_msg').innerHTML = `لا يوجد مستشفى فى هذه المدينة عليك تحديد مدينة أخر أقرب إليك يوجد بها مستشفى أخرى `
    } 
}

document.querySelector('#sendData').addEventListener('click',function(e){
    e.preventDefault();
    book_appointment_to_donate();
    setTimeout(()=>{
        window.location.reload();
    },6500)
});

/*******************************  End Add *******************************/


// Submit
document.querySelector('.main-box').addEventListener('change',function () {

        let sendData = document.querySelector('#sendData');

        if(val_gov && val_city && place_name_x && user_blood_type && date){
            sendData.disabled = !1
        }
        else{
            sendData.disabled = !0
        }

});
