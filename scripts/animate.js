gsap.timeline({
    scrollTrigger: {
      trigger: ".grafica",
      start: "center bottom",
      end: "+=50%",
      scrub: true,
      markers: true
    }
  })
  .from("#Pin",  { y: -200 }, 0)
  .to("#Pin",  { y: 0 }, 0)
  .to("#Searchbar", { y:  0 }, 0)
  .to("#Botticelli", { y: 0 }, 0)