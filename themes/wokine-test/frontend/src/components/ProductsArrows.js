export function initProductsArrows() {
  const container = document.querySelector(".products-cards-container");
  const btnNext = document.querySelector(".products-arrow-right");
  const btnPrev = document.querySelector(".products-arrow-left");

  if (!container || !btnNext || !btnPrev) return;

  const getStep = () => {
    const card = container.querySelector(".products-card");
    if (!card) return container.clientWidth * 0.8;
    const style = getComputedStyle(container);
    const gap = parseFloat(style.columnGap || style.gap || "24");
    return card.offsetWidth + gap;
  };

  btnNext.addEventListener("click", () => {
    container.scrollBy({
      left: -getStep(),
      behavior: "smooth",
    });
  });

  btnPrev.addEventListener("click", () => {
    container.scrollBy({
      left: getStep(),
      behavior: "smooth",
    });
  });
}
