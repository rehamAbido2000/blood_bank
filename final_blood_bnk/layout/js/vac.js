/* To Get Id From Url */ 
const url = window.location.href;
const str = url.split('=');
let v_id = str[1];
/* End */

let av_Vaccines = [];
let Vac;
var Val;

const spinner = document.querySelector(".spinner");

function showSpinner() {
    spinner.classList.add('show');
}
function hideSpinner() {
    spinner.classList.remove('show')
}


// Function To Get All Vaccines
async function GetVaccines(){
    showSpinner()
    // To Get All Vaccines
    let Response = await fetch(`https://blood-bank.life/api/api/v1/all_vaccones_info/530504012422/all`);
    if(Response.ok && Response.status != 400){

        let results = await Response.json();
        av_Vaccines =  results.data;

        // Get Specific Vaccine to get its data  
        for (let i = 0; i < av_Vaccines.length; i++) {
            if(v_id == av_Vaccines[i].vaccine_id){

                Vac = av_Vaccines[i];

            }
        }
        hideSpinner()
        // Display Vaccine Data
        DisplayVaccineData();

    } 
}

GetVaccines();


// Function Display Vaccine Data
function DisplayVaccineData(){
    // Vaccine Scientific Name, Trade Name,Country and Place
    let Vaccine = document.querySelector('#Vaccine');
    let In_Vaccine =  ` 
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card__exit"><i class="fas fa-bolt"></i></p>
                                    <div class="card__icon"><i class="fas fa-viruses"></i></div>
                                </div>
                                <h4 class="card__title mb-2"> اسم اللقاح العلمي</h4>
                                <p class="card-reply">${Vac.scientific_name}</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card__exit"><i class="fas fa-bolt"></i></p>
                                    <div class="card__icon"><i class="fas fa-viruses "></i></div>
                                </div>
                                <h4 class="card__title mb-2">الأسم التجارى</h4>
                                <p class="card-reply">${Vac.trade_name}</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card__exit"><i class="fas fa-bolt"></i></p>
                                    <div class="card__icon"><i class="fas fa-viruses "></i></div>
                                </div>
                                <h4 class="card__title mb-2">بلد النمشأ</h4>
                                <p class="card-reply">${Vac.country_name}</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card__exit"><i class="fas fa-bolt"></i></p>
                                    <div class="card__icon"><i class="fas fa-viruses "></i></div>
                                </div>
                                <h4 class="card__title mb-2">المكان</h4>
                                <p class="card-reply">${Vac.hospital_name}</p>
                            </div>
                        </div>
                    `;
    Vaccine.innerHTML = In_Vaccine;
    // End
    // Buy Vaccine and Amount and Price
    let B_Vaccine = document.querySelector('#priceVaccine');
    let priceVaccine =`
                            <label for="priceOfvaccine">سعر العبوه</label>
                            <div class="form-group mb-0">
                                <input type="text" class="form-control"
                                    id="priceOfvaccine" name="priceOfvaccine" value="جنية ${Vac.price} " disabled>
                                <div class="field-icon"><i class="fas fa-money-bill-wave"></i></div>
                                
                            </div>          
                    `
    B_Vaccine.innerHTML = priceVaccine;
    // End
}
//  To Calc the Total Price of Vaccine Bags
let vaccine_bags_num = document.querySelector('#vaccine_bags_num');
vaccine_bags_num.onchange = ()=>{
   
   let sel_value = vaccine_bags_num.options[vaccine_bags_num.selectedIndex].value;
   Val = sel_value
   document.querySelector('#totalPriceOfvaccine').setAttribute('value',`جنية ${Vac.price * Val}`)
}


$(document).ready(function(){
    $('.ui.modal')
    .modal('show')
  ;
})


