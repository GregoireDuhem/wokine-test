import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import SplitText from "gsap/SplitText";

gsap.registerPlugin(ScrollTrigger, SplitText);

export function initTextReveal() {
  const elements = document.querySelectorAll(".text-reveal");

  elements.forEach((el) => {
    const split = new SplitText(el, {
      type: "words",
      wordsClass: "reveal-inner",
    });

    split.words.forEach((wordEl) => {
      const wrapper = document.createElement("span");
      wrapper.classList.add("reveal-word");
      wordEl.parentNode.insertBefore(wrapper, wordEl);
      wrapper.appendChild(wordEl);
    });

    const targets = split.words;

    gsap.from(targets, {
      opacity: 0,
      yPercent: 200,
      duration: 1,
      ease: "power2.out",
      stagger: 0.05,
      scrollTrigger: {
        trigger: el,
        start: "top 80%",
        toggleActions: "play none none reverse",
      },
    });
  });
}
