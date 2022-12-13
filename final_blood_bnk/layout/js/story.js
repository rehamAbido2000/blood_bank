
$('.testimonial_owlCarousel').owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    nav:true,
    autoplay:false,   
    smartSpeed: 1000, 
    autoplayTimeout:4000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

const spinner = document.querySelector(".spinner");

function showSpinner() {
    spinner.classList.add('show');
}
function hideSpinner() {
    spinner.classList.remove('show')
}


let Stories = [];

// Function Get All Stories
async function GetStories(){
    showSpinner()
    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_stories_info/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Stories =  results.data;
        hideSpinner()
        displayStories();  
    } 
}

// Function Get All Users
let Users = [];
async function GetUsers(){
    showSpinner()
    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_patients_donners_info/530504012422/all`);
    if(Response.ok && Response.status != 400){
        let results = await Response.json();
        Users =  results.data;
        hideSpinner();
    } 
}

async function print(){
    await GetUsers();
    await GetStories();
}
print();



function displayStories(){
    let AllStories = document.querySelector('#Stories');
    let Male = "img/imgs/male.jpeg";
    let Female = "img/imgs/female.jpeg";
    let stories=``;
    for (let i = 0 ; i <Stories.length ; i++) {
        for (let j = 0; j < Users.length; j++) {
        
            if(Users[j].p_ssn == Stories[i].p_ssn){

                stories += `
                    <div class="col-md-6" >
                        <div class="testimonials ">
                            <div class="testimonial_content">
                                <div class="testimonial_caption">
                                    <h6>${Stories[i].first_name} ${Stories[i].last_name} </h6>
                                    <span>${Stories[i].governorate_name} ,${Stories[i].city_name}</span>
                                </div>
                                <p>${Stories[i].content}</p>
                            </div>
                            <div class="images_box">
                                <div class="testimonial_img">
                                    <img class="img-center" src= "${Users[j].gender == "Male" ? Male : Female}" alt="${Users[j].p_first_name}${Users[j].p_last_name}">
                                </div>
                            </div>
                        </div>   
                    </div>
                        `
            }
        }
    }
    AllStories.innerHTML = stories;
}



let add_story = document.getElementById("addStory");
let userSsn = document.getElementById("ssn");
let parse_ssn = parseInt(userSsn.value);
let content = document.querySelector(".msg_content");

// for buttons 
if(parse_ssn == 0){
    document.querySelector('.main-btns').classList.add('d-none')
}

else{
    document.querySelector('.btn-login').classList.add('d-none');
}

// ---------------------add story------------------------
async function Add() {
    let Data_story = {

        p_ssn:parse_ssn,
        content:content.value
        
    }
    
        let Response = await fetch(`https://blood-bank.life/api/api/v1/stories/530504012422/add`,
            {
            method:'POST',
            headers:{'Content-Type':'application/json'}, //mean that interact with json 
            mode:'no-cors',
            body:JSON.stringify(Data_story)
            }
        );
    
        let finalRe = await Response.json();
        content.value = ``;

}

document.querySelector('#addStory').addEventListener('click',function(e){

    e.preventDefault();
    
    if(content.value == ``){
        toastr.error(`<p class="text-center">يجب كتابة شئ هنا</p>`);
    }
    else{
        Add();
        toastr.success(`<p class="text-center">لقد تم إنشاء قصتك بنجاح</p>`);
    
        setTimeout(()=>{
            let dash_Story=  window.location.href = `userStory.php`;
            dash_Story.reload();
        },2500);
    }

});

// Toastr bluggin Set the options that I want
toastr.options = {
    "progressBar": true,
    "preventDuplicates": false,
    "timeOut": "2000",
}