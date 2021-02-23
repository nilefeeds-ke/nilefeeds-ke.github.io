window.onload = function(){
    document.body.addEventListener("DOMContentLoaded", function() {

        document.querySelector('form').addEventListener('submit', handleSubmit);
    });


    // Handle Form Submission
    const handleSubmit = (e) => {
        e.preventDefault();

        let name = document.getElementById('name');
        let email = document.getElementById('email');
        let message = document.getElementById('message');
        let formData = new FormData({name, email, message});
        // TODO: complete form data processing
    }


    //Provide Window Height Per section
    const x = document.getElementsByClassName('h');
    for(let y in x) {
        x[y].style = 'min-height: ' + window.innerHeight + 'px';
    }

    //Jump to Top
    const to_top = document.getElementsByClassName('toTop')[0];
    to_top.addEventListener('click', function(){
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
    })



}

// Handle Button Clicks
function handleNav(id){
    const scrollToItem = document.getElementById(id);

    if(scrollToItem!== null){
        window.scrollTo({
            top: scrollToItem.offsetTop,
            behavior: 'smooth'
        })
    }
}


// set box-shadow on window scroll
window.addEventListener('scroll', function(){

    const styles = `box-shadow:  5px 5px 10px #105a1f,-5px -5px 10px #40ff7b; background-color:#000000;`;

    if(window.pageYOffset>20){
        document.getElementsByClassName('nav')[0].style= styles;
    }
    else{
        document.getElementsByClassName('nav')[0].style=`box-shadow:  0;`
    }
})