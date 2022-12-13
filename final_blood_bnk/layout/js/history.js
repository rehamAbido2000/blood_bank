const days = ['الأحد', 'الأتنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعه', 'السبت'];


// Portfolio
var mixer = mixitup('.port'); 
// End Portfolio

let P_ssn = document.querySelector('#ssn').value;
let Post_id;


// Start spinner
const spinner = document.querySelector(".spinner");

function showSpinner() {
    spinner.classList.add('show');
}
function hideSpinner() {
    spinner.classList.remove('show');
}
// End spinner

/**************************************Start*****************************************/

let Posts = [];
async function GetPosts(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_quick_requests_info/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Posts =  results.data;
        hideSpinner();
        
        displayData();  
    } 
}

function displayData(){
    
    let AllPosts = document.querySelector('#Posts');
    let posts=``;
    for (let i = 0 ; i < Posts.length ; i++) {
        
        let post_Day = Posts[i].time.split(' ')[0];
        let bags = parseInt(Posts[i].blood_bags_number);
        if(P_ssn == Posts[i].p_ssn){

            Post_id = Posts[i].id
            let new_count =  getAllVolunteer(Post_id,bags);

            posts += `
                <div class="col-xl-9 col-md-9">
                    <div class="post text-end bg-white" post-id="${Posts[i].id}">
    
                        <div class="person p-3 d-flex justify-content-end align-items-center">
                         
                                <div class="per-inf">
                                    <h3>${Posts[i].first_name} ${Posts[i].last_name}</h3>
                                    <p class="mb-0"><b>فى  ${Posts[i].hospital_name}</b> ${Posts[i].blood_type}  يبحث عن  </p>
                                    <small class="text-secondary">${post_Day}</small>
                                </div>
                            
                            <div class="per-img">
                                <img src="img/testimonials/mohammad.svg" alt="Mohamed Image">
                            </div>
                        </div>
    
                        <p class="p-3"> ${Posts[i].blood_type}  أكياس من النوع  ${Posts[i].message}</p>
    
                        <div class="details d-flex justify-content-end align-items-center">
                            <div class="details-inf me-3">
                                <h3> ${Posts[i].blood_type} مطلوب متبرعين ب</h3>
                                <p class="mb-0 ">محافظة ${Posts[i].governorate_name}،  ${Posts[i].hospital_name}<i class="fas fa-map-marker-alt ms-2 text-secondary"></i></p>
                            </div>
                            <div class="details-img">
                                <span>${Posts[i].blood_type}</span>
                            </div>
                        </div>
    
                        <div class="num-comments d-flex justify-content-end py-1 px-3">
                        <small class="text-secondary">مطلوب<span  class="countGo mx-2 text-danger" >${new_count}</span>متطوعين</small>    
                            <span id="emoj"></span>
                        </div>
    
                        <div class="contact py-2 px-3 ">
                            <ul class="list-unstyled mb-0 d-flex flex-row-reverse flex-wrap position-relative justify-content-center">
                                <li class="contact-like m-md-2 m-2">
                                    <button class="bookmark" data-bs-toggle="modal" data-bs-target="#saveBloodRequest">حفظ</button>
                                </li>

                                <li class="contact-comment m-md-2 m-2">
                                    <button class="go_donar" data-bs-toggle="modal" data-bs-target="#Comments">المتطوعين</button>
                                </li>
                                
                            </ul>
    
                        </div>
    
                    </div>
                </div>
                `
        }
    }
    if(posts != ''){
        AllPosts.innerHTML = posts;
        document.querySelector('.No_Posts').innerHTML = ``;
    }
    else{
        AllPosts.innerHTML = ``;
        document.querySelector('.No_Posts').innerHTML = `لا يوجد طلبات قمت بها`;
    }
}

GetPosts();

/**********************************End And Start****************************************/

let savedPosts = [];
async function GetsavedPosts(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/saved_blood_requests/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        savedPosts =  results.data;
        hideSpinner();
        
    } 
}

GetsavedPosts();

// click On Save Button To add Post to favorites Page
document.addEventListener('click',(e)=>{
    if(e.target.classList.contains('bookmark')){

        Post_id = e.target.parentNode.parentNode.parentNode.parentNode.getAttribute('post-id');
        document.querySelector('#saveBlood_msg').innerHTML =``

        for (let i = 0; i < savedPosts.length; i++) {
            
            if(P_ssn == savedPosts[i].p_ssn){

                if( Post_id == savedPosts[i].request_id ){
                    document.querySelector('#saveBlood_msg').innerHTML = `عذرا لقد تم حفظ طلب التبرع ذلك من قبل`;
                }
                
            }
        
        }
        if(document.querySelector('#saveBlood_msg').innerHTML == ``){

            document.querySelector('#saveBlood_msg').innerHTML = `لقد تم حفظ طلب التبرع بنجاح إلى صفحة المفضلات الخاصة بك`;
    
            setTimeout(()=>{
                Add_Post();
            },600);

            setTimeout(()=>{
                let dash_Favorites=  window.location.href = `dash-favorites.php`;
                dash_Favorites.reload();
            },4000);
        }

    }
});

/*******************************  Start Add Post to Dash favorites  *******************************/
async function Add_Post() {

    let Req_Save_Data = {

        request_id:Post_id,
        p_ssn:P_ssn
    
    }
        let Response = await fetch(`https://blood-bank.life/api/api/v1/saved_blood_requests/530504012422/add`,
        {
            method:'POST',
            headers:{'Content-Type':'application/json'}, //mean that interact with json 
            mode:'no-cors',
            body:JSON.stringify(Req_Save_Data)
        }
        );
        let finalRe = await Response.json();
    }
/*******************************  End Add Post to Dash favorites  *******************************/

/******************************************End And Start ************************************/

let Go_donars = [];
async function Get_Go_donars(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/going_donners/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Go_donars =  results.data;
        hideSpinner(); 
    } 
}

Get_Go_donars();

// get all volunteers to add count of them in span that express about them
function getAllVolunteer(Post_id,bags) {
    
    let GoDonaCount = [] ;
    for (let h = 0; h < Go_donars.length; h++) {
        if(Post_id == Go_donars[h].request_id){
            GoDonaCount.push(1);
        }
    }

    let CountGo = bags + 2;
    let new_count =  CountGo - GoDonaCount.length;
    
    if(new_count < 0){
        new_count = 0;           
    }

    return new_count

}

/******************************************End And Start ************************************/


let users = [];
async function Getusers(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/patients_donors/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        users =  results.data;
        hideSpinner();
        
    } 
}

async function print_going_don() {  
    await GetPosts();
    await Get_Go_donars();
    await Getusers();    
}

print_going_don();

// click On Go Button To add Person in Going Volunteers List in comments
document.addEventListener('click',(e)=>{

    if(e.target.classList.contains('go_donar')){

        donarsArr = [];

        let com_body =  document.querySelector('#com_body');
        com_body.innerHTML = ``;
        document.querySelector('.No_Going_don').classList.remove('d-none');
        
        Post_id = e.target.parentNode.parentNode.parentNode.parentNode.getAttribute('post-id');
        
        for (let i = 0; i < Go_donars.length; i++) {
            
            if(Post_id == Go_donars[i].request_id){

                Go_P_Ssn = Go_donars[i].donner_id;
                donarsArr.push(Go_P_Ssn);

                let comment =``;

                for (let h = 0; h < users.length; h++) {
                    
                    for (let j = 0; j < donarsArr.length; j++) {
                        if(donarsArr[j] == users[h].p_ssn){
                            comment += `
                                <div class="comm-comments">
                                            <!-- /***************** For Comments inside comm-body  *****************/ -->
                                            <div class="first d-flex justify-content-between mb-3">
                                                <div class="com-update d-flex justify-content-between align-items-center flex-column"> 
                                                    <small class="time">${users[h].time.split(' ')[0]}</small>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="com-details text-end">
                                                        <h5 class="person-name mb-2">${users[h].p_first_name} ${users[h].p_last_name}</h5>
                                                        <p>${users[h].mobile_phone}</p>
                                                    </div>
                                                    <img class="img-thumbnail rounded-circle" src="img/testimonials/man1.svg" alt="man">
                                                </div>
                                            </div>
                                            <!-- /***************** End For Comments inside comm-body  *****************/ -->
                                        </div>
                                `
                        }
                    }
                    if(comment){
                        document.querySelector('.No_Going_don').classList.add('d-none');
                        com_body.innerHTML = comment;
                    }
                    else{
                        document.querySelector('.No_Going_don').classList.remove('d-none');
                        com_body.innerHTML = ``;
                    }
                }
                
            }
        }
    
    }
});



// for vac requests and blood requests
let places = [];

async function GetPlaces(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/donate_places/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        places =  results.data;
        hideSpinner(); 
    } 
}
// end

/**************************************End And Start*****************************************/

let vaccines = [];

async function GetVaccine(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_vaccones_info/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        vaccines =  results.data;
        hideSpinner(); 
    } 
}


let vaccine_order = [];

async function GetVaccine_order(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/order_vaccine/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        vaccine_order =  results.data;
        hideSpinner();
        
        displayVaccine_order();  
    } 
}

let vacOrder = [];
let vacPlaceOrder = [];
let vacTimeOrder = [];
let vac_orders = document.querySelector('#vacReqs');

function vaccine_And_place(x,y,z) {

    vacTimeOrder.push(z.split(" ")[0]);
    
    let orders=``;

    for (let j = 0; j < vaccines.length; j++) {
        
        if(x == vaccines[j].id){
            vacOrder.push(vaccines[j].scientific_name);
            vacOrder.push(vaccines[j].trade_name);
            vacOrder.push(vaccines[j].country_name);
            vacOrder.push(vaccines[j].price);
        }
        
    }

    for (let h = 0; h < places.length; h++) {
        
        if(y == places[h].id){
            vacPlaceOrder.push(places[h].place_name)
        }
    }

    for (let index = 0; index < vacPlaceOrder.length; index++) {
        let d = new Date(vacTimeOrder[index]);
        let dayName = days[d.getDay()];
        orders += `

        <div class="col-12">
            <div class="center">
                <div class="vaccine_card">
                    <div class="additional">
                    <div class="user-card">
                        <div class="level center">
                            <span>${vacOrder[index]}</span>
                        </div>
                        <div class="points center">
                        <span>${vacOrder[index + 3]} جنيها</span>
                        </div>
                        <div class="virus-img">
                        <img src="img/imgs/vaccine.png" alt="virus Image">
                        </div>
                        
                    </div>
                    <div class="more-info">
                        <h2>${vacOrder[index]}</h2>
                        <div class="coords">
                        <h4 class="text-center">( ${vacOrder[index + 1]} )</h4>
                        <p class=" text-center">( ${vacOrder[index + 2]} )</p>
                        <p class=" py-md-2"> هذا اللقاح خاص بمرضى فيرس الكرونا يتم اعطاؤه من قبل الهيئة المسؤلة عن اعطاء اللقاحات  </p>
                        </div>
                    </div>
                    </div>
                    <div class="general m-auto  mb-2 text-center">
                    <h2 class="mb-2">طلب اللقاح</h2>
                    <p class="mb-2">لقد قمت بطلب هذا اللقاح من خلال موقعنا في تاريخ </p>
                    <span> يوم ${dayName} : ${vacTimeOrder[index]}  </span>
                    <p class="my-2">مكان الأستلام : ${vacPlaceOrder[index]} </p>
            
                    <div class="success-msg  text-center d-none">
                        <i class="fa fa-check"></i>
                        <span>حسنا لقد تم قبول طلبك</span>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        
        `
    }

    vac_orders.innerHTML = orders;

}

function displayVaccine_order(){

    for (let i = 0 ; i < vaccine_order.length ; i++) {

        if(P_ssn == vaccine_order[i].p_ssn){

            vaccine_And_place(vaccine_order[i].vaccine_id,vaccine_order[i].delivered_place,vaccine_order[i].time);

        }
    }

    if(vac_orders.innerHTML == ``){
        vac_orders.innerHTML = `<p class="text-danger text-center fs-5 fw-bold mt-4">لا يوجد طلبات لقاح قمت بها</p>`
    }

}


async function VacPrint() { 
    await GetVaccine();
    await GetPlaces();
    await GetVaccine_order();
}

VacPrint();

/**************************************End And Start*****************************************/

let blood_types = [];

async function GetBlood_types(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/blood_type/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        blood_types =  results.data;
        hideSpinner(); 
    } 
}


let blood_orders = [];

async function GetBlood_orders(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/purchase_order/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        blood_orders =  results.data;
        hideSpinner();
        
        displayBlood_orders();  
    } 
}

let bloodOrder = [];
let placeOrder = [];
let timeOrder = [];
let Blood_orders = document.querySelector('#bloodReqs');

function blood_And_place(x,y,z) {

    timeOrder.push(z.split(" ")[0]);
    
    let orders=``;

    for (let j = 0; j < blood_types.length; j++) {
        
        if(x == blood_types[j].id){
            bloodOrder.push(blood_types[j].name)
        }
        
    }

    for (let h = 0; h < places.length; h++) {
        
        if(y == places[h].id){
            placeOrder.push(places[h].place_name)
        }
    }

    for (let index = 0; index < bloodOrder.length; index++) {
        let d = new Date(timeOrder[index]);
        let dayName = days[d.getDay()];
        orders += `

            <div class="col-md-6">
                <div class="card card-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card__exit"><i class="fas fa-bolt"></i></p>
                        <div class="card__icon">    <i class="fas fa-viruses "></i></div>
                    </div>
                    <div class="general m-auto  mb-2 text-center">
                        <h2 class="mb-2">طلب دم</h2>
                        <span class="mb-2">${bloodOrder[index]} فصيلة دم</span>
                        <p class="mb-2">لقد قمت بطلب هذا الدم من خلال موقعنا في تاريخ </p>
                        <span>${timeOrder[index]} : يوم ${dayName}</span>
                        <p class="mt-2">مكان الأستلام : ${placeOrder[index]} </p>

                        <div class="success-msg mt-5 text-center d-none">
                            <i class="fa fa-check"></i>
                            <span>حسنا لقد تم قبول طلبك</span>
                        </div>
                    </div>
                </div>
            </div>
        
        
        `
    }

    Blood_orders.innerHTML = orders;

}

function displayBlood_orders(){

    for (let i = 0 ; i < blood_orders.length ; i++) {

        if(P_ssn == blood_orders[i].p_id){

            blood_And_place(blood_orders[i].blood_type,blood_orders[i].delivered_place,blood_orders[i].time);

        }
    }

    if(Blood_orders.innerHTML == ``){
        Blood_orders.innerHTML = `<p class="text-danger text-center fs-5 fw-bold mt-4">لا يوجد طلبات دم قمت بها</p>`
    }

}


async function bloodPrint() { 
    await GetBlood_types();
    await GetPlaces();
    await GetBlood_orders();
}

bloodPrint();

/**************************************End And Start*****************************************/

let Donation = [];
let donate_ids = [];

async function GetDonation(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/blood_donation/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Donation =  results.data;
        hideSpinner();
        
        displayDonateData();  
    } 
}

function  displayDonateData() {

    let last_donate_date = document.querySelector('#last_donate_date');

    for (let i = 0; i < Donation.length; i++) {        
        if(P_ssn == Donation[i].p_ssn){

            donate_ids.push(Donation[i].id);

        }
    }
    
    let last_donate_id = donate_ids.at(-1);
    
    if (donate_ids.includes(last_donate_id)) {
        
        for (let i = 0; i < Donation.length; i++) {   
        
            if(last_donate_id == Donation[i].id){
                
                let donate_day = Donation[i].time.split(' ')[0];
                let d = new Date(donate_day);
                let dayName = days[d.getDay()];
    
                last_donate_date.innerHTML = `${donate_day} : يوم ${dayName} `
            }
        }

    } else {

        last_donate_date.innerHTML = `لا يوجد أى تبرع قمت به إلى الأن`
    
    }


}

GetDonation();

/**************************************End And Start*****************************************/
