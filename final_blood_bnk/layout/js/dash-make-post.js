
let P_ssn = document.querySelector('#ssn').value;
let donarsArr = [];
let Post_id;
let Go_P_Ssn;
const spinner = document.querySelector(".spinner");

function showSpinner() {
    spinner.classList.add('show');
}
function hideSpinner() {
    spinner.classList.remove('show');
}
// End Spinner

// Start

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
                <div class="col-xl-6 col-md-8">
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
                                <li class="contact-like m-md-1 m-2">
                                    <button class="bookmark" data-bs-toggle="modal" data-bs-target="#saveBloodRequest">حفظ</button>
                                </li>
                                <li class="contact-comment m-md-1 m-2">
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

let Going_donars = [];
async function GetGoing_donars(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/going_donners/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Going_donars =  results.data;
        hideSpinner();
        
    } 
}

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

async function print() {  
    await GetPosts();
    await GetGoing_donars();
    await Getusers();    
}

print();

// click On Go Button To add Person in Going Volunteers List
document.addEventListener('click',(e)=>{

    if(e.target.classList.contains('go_donar')){

        donarsArr = [];

        let com_body =  document.querySelector('#com_body');
        com_body.innerHTML = ``;
        document.querySelector('.No_Going_don').classList.remove('d-none');
        
        Post_id = e.target.parentNode.parentNode.parentNode.parentNode.getAttribute('post-id');
        
        for (let i = 0; i < Going_donars.length; i++) {
            
            if(Post_id == Going_donars[i].request_id){

                Go_P_Ssn = Going_donars[i].donner_id;
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

// End

// Start

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

// End


// Start


async function print_for_get_allVol() {  
    await GetGoing_donars();
    await GetPosts();
}

print_for_get_allVol();

// get all volunteers to add count of them in span that express about them
function getAllVolunteer(Post_id,bags) {
    
    let GoDonaCount = [] ;
    for (let h = 0; h < Going_donars.length; h++) {
        if(Post_id == Going_donars[h].request_id){
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

// End