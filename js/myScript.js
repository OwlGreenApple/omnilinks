
var slideIndex,slides,dots,captionText;
function initGallery()
{
    slideIndex = 0;
    slides=document.getElementsByClassName("imageHolder");
    if (slides.length>0){
      slides[slideIndex].style.opacity=1;
      captionText=document.querySelector(".captionTextHolder .captionText");
      captionText.innerText=slides[slideIndex].querySelector(".captionText").innerText;
      //disable nextPrevBtn if slide count is one
      if(slides.length<1){
          var nextPrevBtns=document.querySelector(".leftArrow,.rightArrow");
          nextPrevBtns.style.display="none";
          document.getElementById('right').style.display="none";
          for (i = 0; i < nextPrevBtn.length; i++) {
              nextPrevBtn[i].style.display="none";
          }
      }
      
      //dots keluar kalo banner lebih dari 1
      if(slides.length>1){
          //add dots
          dots=[];
          var dotsContainer=document.getElementById("dotsContainer"),i;
          for (i = 0; i < slides.length; i++) {
              var dot=document.createElement("span");
              dot.classList.add("dots");
              dotsContainer.append(dot);
              dot.setAttribute("onclick","moveSlide("+i+")");
              dots.push(dot);
          }
          dots[slideIndex].classList.add("active");
      }
    }
}

function plusSlides(n) {
    moveSlide(slideIndex+n);
}
function moveSlide(n){
    var i;
    var current,next;
    var moveSlideAnimClass={
          forCurrent:"",
          forNext:""
    };
    var slideTextAnimClass;
    if(n>slideIndex) {
        if(n >= slides.length){
            n=0;
        }
        moveSlideAnimClass.forCurrent="moveLeftCurrentSlide";
        moveSlideAnimClass.forNext="moveLeftNextSlide";
        slideTextAnimClass="slideTextFromTop";
    }else if(n<slideIndex){
        if(n<0){n=slides.length-1;}
        moveSlideAnimClass.forCurrent="moveRightCurrentSlide";
        moveSlideAnimClass.forNext="moveRightPrevSlide";
        slideTextAnimClass="slideTextFromBottom";
    }
    if(n!=slideIndex){
        next = slides[n];
        current=slides[slideIndex];
        for (i = 0; i < slides.length; i++) {
            slides[i].className = "imageHolder";
            slides[i].style.opacity=0;
            dots[i].classList.remove("active");
        }
        current.classList.add(moveSlideAnimClass.forCurrent);
        next.classList.add(moveSlideAnimClass.forNext);
        dots[n].classList.add("active");
        slideIndex=n;
        captionText.style.display="none";
        captionText.className="captionText "+slideTextAnimClass;
        captionText.innerText=slides[n].querySelector(".captionText").innerText;
        captionText.style.display="block";
    }

}

