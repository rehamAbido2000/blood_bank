

const spinner = document.querySelector(".spinner");

function showSpinner() {
    spinner.classList.add('show');
}
function hideSpinner() {
    spinner.classList.remove('show')
}



let User_ssn = document.getElementById("ssn").value;
let Stories = [];

// Function Get All Stories
async function GetStories() {
    showSpinner();
  let Response = await fetch(
    `https://blood-bank.life/api/api/v1/all_stories_info/530504012422/all`
  );
  if (Response.ok && Response.status != 400) {

    let results = await Response.json();
    Stories = results.data;
    hideSpinner();
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


// function Show stories of user
function displayStories() {
    let AllStories = document.querySelector("#Stories");
    let Male = "img/imgs/male.jpeg";
    let Female = "img/imgs/female.jpeg";
    let stories = ``;
    for (let i = 0; i < Stories.length; i++) {
        if (Stories[i].p_ssn == User_ssn) {
            for (let j = 0; j < Users.length; j++) {
                if(Users[j].p_ssn == Stories[i].p_ssn){
                    stories += `
                                <div class="col-md-6">
                                
                                    <div class="testimonials" >
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

                                    <div class="btns d-flex align-items-center justify-content-center py-3">
                                            <button class="delete" onclick="DeletePost(${Stories[i].id})" data-bs-toggle="modal" data-bs-target="#deleteStory">حذف</button>
                                    </div>
                                </div>
                                    `;
                }
            }
        }
    }
    AllStories.innerHTML = stories;
}


// Delete Story 
async function DeletePost(id){
    let post_Data = {
        id:id
    }
    console.log(post_Data)
    let Response = await fetch(`https://blood-bank.life/api/api/v1/stories/530504012422/delete`,
    {
        method:'DELETE',
        headers:{'Content-Type':'application/json'}, //mean that interact with json 
        body:JSON.stringify(post_Data)
    }
    );
    let finalRe = await Response.json();

    document.querySelector('#delete_msg').innerHTML = `لقد تم حذف قصتك بنجاح`;
    
    setTimeout(()=>{
        let dash_Story=  window.location.href = `userStory.php`;
        dash_Story.reload();
    },3000);

}



