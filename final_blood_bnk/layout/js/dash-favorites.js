let P_ssn = document.querySelector('#ssn').value;
let Post_id;
let donarsArr = [];
let saved_post_id = [];
let saved_requests = [];
let Posts = [];
let Go_donars = [];
let saveReq_id;


// Start Spinner
const spinner = document.querySelector(".spinner");

function showSpinner() {
    spinner.classList.add('show');
}
function hideSpinner() {
    spinner.classList.remove('show');
}
// End Spinner



async function saved_blood_requests(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/saved_blood_requests/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        saved_requests =  results.data;
        hideSpinner();
        getUserPost()
    } 
}

function getUserPost(){

    for (let i = 0; i < saved_requests.length; i++) {

        if(P_ssn == saved_requests[i].p_ssn){

            saved_post_id.push(saved_requests[i].request_id,saved_requests[i].id);

        }
    }

}

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
    // Loop to set values in post
    for (let i = 0 ; i < Posts.length ; i++) {
    
        // Loop to get post id
        for (let j = 0; j < saved_post_id.length; j++) {
            
            if(saved_post_id[j] == Posts[i].id){
                
                    let post_Day = Posts[i].time.split(' ')[0];
                    let bags = parseInt(Posts[i].blood_bags_number);

                    Post_id = Posts[i].id;

                    let new_count = getAllVolunteer(Post_id,bags);

                    posts += `
                        <div class="col-xl-6 col-md-8">
                            <div class="post text-end bg-white" post-id="${Posts[i].id}" saved-req-id="${saved_post_id[j + 1]}">
            
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
                                            <button class="bookmark" data-bs-toggle="modal" data-bs-target="#unSaveBloodRequest">إلغاء الحفظ</button>
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


async function Get_Go_donars(){
    
    showSpinner();
    let Response = await fetch(`https://blood-bank.life/api/api/v1/going_donners/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Go_donars =  results.data;
        hideSpinner(); 
    } 
}


// To Fire saved_blood_requests fun first then GetPosts fun
async function print_save_msg(){

    await saved_blood_requests();
    await GetPosts();

    $('.contact-like').click((e)=>{
        if(e.target.classList.contains('bookmark')){
            
            document.querySelector('.bookmark').innerHTML = 'حفظ';
            saveReq_id = e.target.parentNode.parentNode.parentNode.parentNode.getAttribute('saved-req-id');
            document.querySelector('#unSaveBlood_msg').innerHTML = `لقد تم إلغاء حفظ طلب الدم بنجاح من صفحة المفضلات الخاصة بك`;

            setTimeout(()=>{
                DeletePost(saveReq_id);
            },700);
            
            setTimeout(()=>{
                let dash_Favorites=  window.location.href = `dash-favorites.php`;
                dash_Favorites.reload();
            },3500);

        }

    });

}

print_save_msg();

// Delete Post 
async function DeletePost(id){
    let post_Data = {

        id:id
    
    }
        let Response = await fetch(`https://blood-bank.life/api/api/v1/saved_blood_requests/530504012422/delete`,
        {
            method:'DELETE',
            headers:{'Content-Type':'application/json'}, //mean that interact with json 
            body:JSON.stringify(post_Data)
        }
        );
        let finalRe = await Response.json();
}


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


Get_Go_donars()
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