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
        x[y].style = 'height: ' + window.innerHeight + 'px';
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