let P_ssn = document.querySelector('#ssn').value;
let Post_id;
const Months = ['01','02','03','04','05','06','07','08','09','10','11','12'];

let C_Date , Day , Month , Year; 

C_Date = new Date();

Day = C_Date.toString().split(' ')[2];
Month = Months[C_Date.getMonth()];
Year = C_Date.toString().split(' ')[3];

C_Day = Year + '-' + Month + '-' + Day ;

// Function To Get Specific Day
function CalcSpecificDay(C_Day , countDays){

  let date = new Date(C_Day);
  date.setDate(date.getDate() - countDays);
  let Day = date.toString().split(' ')[2];
  let Month = Months[date.getMonth()];
  let Year = date.toString().split(' ')[3];

  return  Year + '-' + Month + '-' + Day ;

}
// End

// Start spinner
const spinner = document.querySelector(".spinner");

function showSpinner() {
    spinner.classList.add('show');
}
function hideSpinner() {
    spinner.classList.remove('show');
}
// End spinner

// Filter
$(".list1 a").click(function(e) { 

    $(".list1 a").removeClass("filter-active")
    $(e.target).addClass("filter-active")
});

$(".list2 a").click(function(e) { 

    $(".list2 a").removeClass("filter-active_2")
    $(e.target).addClass("filter-active_2")

});


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
        
        let post_Day = Posts[i].time.split(' ')[0]
        let bags = parseInt(Posts[i].blood_bags_number);

        Post_id = Posts[i].id;
        let new_count =  getAllVolunteer(Post_id,bags);
        // class in css make go_donar button disable
            let dis = `dis`;
            let no_dis = `no_dis`;
        // End

        posts += `
        <div class="col-12">
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

                <p class="p-3">${Posts[i].message} ${Posts[i].blood_bags_number}  أكياس من النوع ${Posts[i].blood_type}</p>

                <div class="details d-flex justify-content-end align-items-center">
                    <div class="details-inf me-3">
                        <h3>مطلوب متبرعين بالدم</h3>
                        <p class="mb-0 ">محافظة ${Posts[i].governorate_name}،  ${Posts[i].hospital_name}<i class="fas fa-map-marker-alt ms-2 text-secondary"></i></p>
                    </div>
                    <div class="details-img">
                        <span>${Posts[i].blood_type}</span>
                    </div>
                </div>

                <div class="num-comments d-flex justify-content-end py-1 px-3">
                <small class="text-secondary" >مطلوب<span  class="countGo mx-2 text-danger" >${new_count}</span>متطوعين</small>    
                <span id="emoj"></span>
                </div>

                <div class="contact py-2 px-3 ">
                    <ul class="list-unstyled mb-0 d-flex flex-row-reverse flex-wrap position-relative justify-content-center">
                        <li class="contact-like ms-3">
                            <button class="bookmark" data-bs-toggle="modal" data-bs-target="#saveBloodRequest">حفظ</button>
                        </li>
                        
                        <li class="contact-share">
                            <button class="go_donar ${new_count == 0 ? dis : no_dis}" data-bs-toggle="modal" data-bs-target="#goDonarRequest"  >تلبية الطلب</button>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
        `
    }

    AllPosts.innerHTML = posts;
    document.querySelector('.No_Posts').innerHTML = ``;
}

// Function To Get Posts Today And Yesterday
function GetDatePosts(D){
    let AllPosts = document.querySelector('#Posts');
    
    let posts=``;
    for (let i = 0 ; i < Posts.length ; i++) {
        
        if(D == Posts[i].time.split(' ')[0]){

        let post_Day = Posts[i].time.split(' ')[0];
        let bags = parseInt(Posts[i].blood_bags_number);

        Post_id = Posts[i].id;
        let new_count =  getAllVolunteer(Post_id,bags);

        // class in css make go_donar button disable
            let dis = `dis`;
            let no_dis = `no_dis`;
        // End

        posts += `
        <div class="col-12">
            <div class="post text-end bg-white" post-id="${Posts[i].id}">
  
                <div class="person p-3 d-flex justify-content-end align-items-center">
                    
                        <div class="per-inf">
                            <h3>${Posts[i].first_name} ${Posts[i].last_name}</h3>
                            <p class="mb-0"><b>فى مستشفى ${Posts[i].hospital_name}</b> ${Posts[i].blood_type}  يبحث عن  </p>
                            <small class="text-secondary">${post_Day} يوم</small>
                        </div>
                    
                    <div class="per-img">
                        <img src="img/testimonials/mohammad.svg" alt="Mohamed Image">
                    </div>
                </div>
  
                <p class="p-3">${Posts[i].message} ${Posts[i].blood_bags_number}  أكياس من النوع ${Posts[i].blood_type}</p>
  
                <div class="details d-flex justify-content-end align-items-center">
                    <div class="details-inf me-3">
                        <h3>مطلوب متبرعين بالدم</h3>
                        <p class="mb-0 ">محافظة ${Posts[i].governorate_name}، مستشفى ${Posts[i].hospital_name}<i class="fas fa-map-marker-alt ms-2 text-secondary"></i></p>
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
                        <li class="contact-like ms-3">
                            <button class="bookmark" data-bs-toggle="modal" data-bs-target="#saveBloodRequest">حفظ</button>
                        </li>
                        
                        <li class="contact-share">
                            <button  class="go_donar ${new_count == 0 ? dis : no_dis}" data-bs-toggle="modal" data-bs-target="#goDonarRequest" >تلبية الطلب</button>
                        </li>
                    </ul>
  
                </div>
  
            </div>
        </div>
        `
    }

  }

  if(posts == ''){
    AllPosts.innerHTML = ``;
    document.querySelector('.No_Posts').innerHTML = `لايوجد طلبات يوم ${D}`;
  }
  else{
      AllPosts.innerHTML = posts;
      document.querySelector('.No_Posts').innerHTML = ``;
  }
}

// Function To Get Posts Last Week
function LW_L2W_GetDatePosts(specificDate){

    let AllPosts = document.querySelector('#Posts');
    let posts=``;

    let start = new Date(specificDate);
    let end = new Date(C_Day);
    let loop = new Date(start);


    for( loop ; loop < end ; loop.setDate(loop.getDate() + 1)){

        let Day = loop.toString().split(' ')[2];
        let Month = Months[loop.getMonth()];
        let Year = loop.toString().split(' ')[3];
        let Curr_Date = Year + '-' + Month + '-' + Day;

        for (let i = 0 ; i < Posts.length ; i++) {

            let post_Day = Posts[i].time.split(' ')[0];
            let bags = parseInt(Posts[i].blood_bags_number);

            Post_id = Posts[i].id;
            let new_count =  getAllVolunteer(Post_id,bags);

            // class in css make go_donar button disable
                let dis = `dis`;
                let no_dis = `no_dis`;
            // End

            if(Curr_Date == Posts[i].time.split(' ')[0]){
                    posts += `
                    <div class="col-12">
                        <div class="post text-end bg-white" post-id="${Posts[i].id}">
              
                            <div class="person p-3 d-flex justify-content-end align-items-center">
                               
                                    <div class="per-inf">
                                        <h3>${Posts[i].first_name} ${Posts[i].last_name}</h3>
                                        <p class="mb-0"><b>فى مستشفى ${Posts[i].hospital_name}</b> ${Posts[i].blood_type}  يبحث عن  </p>
                                        <small class="text-secondary">${post_Day} يوم</small>
                                    </div>
                                
                                <div class="per-img">
                                    <img src="img/testimonials/mohammad.svg" alt="Mohamed Image">
                                </div>
                            </div>
              
                            <p class="p-3">${Posts[i].message} ${Posts[i].blood_bags_number}  أكياس من النوع ${Posts[i].blood_type}</p>
              
                            <div class="details d-flex justify-content-end align-items-center">
                                <div class="details-inf me-3">
                                    <h3>مطلوب متبرعين بالدم</h3>
                                    <p class="mb-0 ">محافظة ${Posts[i].governorate_name}، مستشفى ${Posts[i].hospital_name}<i class="fas fa-map-marker-alt ms-2 text-secondary"></i></p>
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
                                    <li class="contact-like ms-3">
                                        <button class="bookmark" data-bs-toggle="modal" data-bs-target="#saveBloodRequest">حفظ</button>
                                    </li>
                                    
                                    <li class="contact-share">
                                        <button class="go_donar ${new_count == 0 ? dis : no_dis}" data-bs-toggle="modal" data-bs-target="#goDonarRequest" >تلبية الطلب</button>
                                    </li>
                                </ul>
              
                            </div>
              
                        </div>
                    </div>
                    `
                }
            
        }
    }
    
    if(posts == ''){
        AllPosts.innerHTML = ``;
        document.querySelector('.No_Posts').innerHTML = `لا يوجد طلبات خلال هذه المدة`;
    }
    else{
        AllPosts.innerHTML = posts;
        document.querySelector('.No_Posts').innerHTML = ``;
    }
}

// To Filter Posts
$('.list2 li a').click((e)=>{
    e.preventDefault();
    if(e.target.innerHTML == 'كل'){
        const spin = setInterval(showSpinner,0);

        setTimeout(()=>{
                clearInterval(spin);
                hideSpinner();
                displayData();
            
            },1500)
        
    }
    else if(e.target.innerHTML == 'اليوم'){
        
        const spin = setInterval(showSpinner,0);

        setTimeout(()=>{
                clearInterval(spin);
                hideSpinner();
                GetDatePosts(C_Day);
            
            },1500)
        
        
    }
    else if(e.target.innerHTML == 'الأمس'){
        const spin = setInterval(showSpinner,0);

        setTimeout(()=>{
                clearInterval(spin);
                hideSpinner();
                let SpecificDay = CalcSpecificDay(C_Day,1);
                GetDatePosts(SpecificDay);
            
            },1500)
        
        
    }
    else if(e.target.innerHTML == 'اخر ٧ ايام'){

        const spin = setInterval(showSpinner,0);

        setTimeout(()=>{
                clearInterval(spin);
                hideSpinner();
                let SpecificDay = CalcSpecificDay(C_Day,7);
                LW_L2W_GetDatePosts(SpecificDay);
            
            },1500)
        

    }
    else if(e.target.innerHTML == 'اخر اسبوعين'){
        const spin = setInterval(showSpinner,0);

        setTimeout(()=>{
                clearInterval(spin);
                hideSpinner();
                let SpecificDay = CalcSpecificDay(C_Day,14);
                LW_L2W_GetDatePosts(SpecificDay);
            
            },1500)
        
    
    }

});


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


async function print() {
    await Get_Go_donars();
    await GetPosts()
}

print();

// click On Go Button To add Person in Going Volunteers List
document.addEventListener('click',(e)=>{
    
    if(e.target.classList.contains('go_donar')){
        
        Post_id = e.target.parentNode.parentNode.parentNode.parentNode.getAttribute('post-id');

        document.querySelector('#goDonar_msg').innerHTML =``

        for (let i = 0; i < Go_donars.length; i++) {
            
            if(P_ssn == Go_donars[i].donner_id){

                if( Post_id == Go_donars[i].request_id ){
                    document.querySelector('#goDonar_msg').innerHTML = `عذرا لقد تم تلبية طلب التبرع ذلك من قبل`;
                }
                
            }
        
        }

        if(document.querySelector('#goDonar_msg').innerHTML == ``){

            document.querySelector('#goDonar_msg').innerHTML = `تم تلبية طلب التبرع بنجاح`;
            setTimeout(()=>{
                Add_Going_Donar();
            },600);

            setTimeout(()=>{
                let lifefeed=  window.location.href = `lifeFeed.php`;
                lifefeed.reload();
            },4000);

        }

    }
})

/*******************************  Start Add_Going_Donar *******************************/
async function Add_Going_Donar() {

    let go_donar_Data = {

        request_id:Post_id,
        donner_id:P_ssn
    
    }
        let Response = await fetch(`https://blood-bank.life/api/api/v1/going_donners/530504012422/add`,
        {
            method:'POST',
            headers:{'Content-Type':'application/json'}, //mean that interact with json 
            mode:'no-cors',
            body:JSON.stringify(go_donar_Data)
        }
        );
        let finalRe = await Response.json();
    }
/*******************************  End Add_Going_Donar *******************************/

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
