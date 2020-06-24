let tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".pinna",
      start: "top top",
      end: "+=3000px bottom",
      scrub: true,
      pin: true,
      anticipatePin: 1,
    //   markers: true
    }
  });

  let tl2 = gsap.timeline({
    scrollTrigger: {
      trigger: ".pinna",
      start: "top top",
      end: "+=3000px bottom",
      scrub: true,
      pin: true,
      anticipatePin: 1,
    //   markers: true
    }
  });

  tl2.from("#text1", {
      opacity:0,
      y:400,
      duration:2
    })
    .from("#text2", {
        opacity:0,
        y:400,
        duration:8
    })
    .from("#text3", {
        opacity:0,
        y:400,
        delay:2,
        duration:6
    })
    .from("#text4", {
        opacity:0,
        y:400,
        duration:2
    });
    

  tl.from("#Searchbar",  { 
          scale: 2,
          opacity: 0,
          y: -100,
          delay: 2,
          duration: 2
    })
    .to("#Searchbar", {
        duration: 1
    })
    .from("#S", {
        opacity: 0,
        duration: 2
    })
    .to("#S", {
        duration: 1
    })
    .from("#A", { opacity: 0,}).to("#A", {duration: 1})
    .from("#N", { opacity: 0,}).to("#N", {duration: 1})
    .from("#D", { opacity: 0,}).to("#D", {duration: 1})
    .from("#R", { opacity: 0,}).to("#R", {duration: 1})
    .from("#O", { opacity: 0,}).to("#R", {duration: 1})
    .from("#B", { opacity: 0,}).to("#B", {duration: 1})
    .from("#O_2", { opacity: 0,}).to("#O_2", {duration: 1})
    .from("#T_2", { opacity: 0,}).to("#T_2", {duration: 1})
    .from("#T", { opacity: 0,}).to("#T", {duration: 1})
    .from("#I", { opacity: 0,}).to("#I", {duration: 1})
    .from("#C", { opacity: 0,}).to("#C", {duration: 1})
    .from("#E", { opacity: 0,}).to("#E", {duration: 1})
    .from("#L", { opacity: 0,}).to("#L", {duration: 1})
    .from("#L_2", { opacity: 0,}).to("#L_2", {duration: 1})
    .from("#I_2", { opacity: 0,}).to("#I_2", {duration: 1})
    .from("#Pin", {
        opacity: 0,
        y: -100,
        delay: 3,
        duration: 3
    })
    .to("#Pin", {
        duration: 2
    })
    .from("#TitleBox, #Firenze", {
        opacity: 0,
        y: -100,
        duration: 2
    })
    .to("#TitleBox, #Firenze", {
        duration:3
    });



 /* 
 .from("#Pin",  { y: -200 }, 0)
  .to("#Pin",  { y: 0 }, 0)
  .to("#Searchbar", { y:  0 }, 0)
  .to("#Botticelli", { y: 0 }, 0)
  */