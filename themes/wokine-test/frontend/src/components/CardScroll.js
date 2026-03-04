export function enableDragScroll(selector) {
  const el = document.querySelector(selector);
  if (!el) return;

  let isDown = false;
  let startX;
  let scrollLeft;

  el.addEventListener("mousedown", (e) => {
    isDown = true;
    el.classList.add("is-dragging");
    startX = e.pageX - el.offsetLeft;
    scrollLeft = el.scrollLeft;
  });

  window.addEventListener("mouseup", () => {
    isDown = false;
    el.classList.remove("is-dragging");
  });

  el.addEventListener("mouseleave", () => {
    isDown = false;
    el.classList.remove("is-dragging");
  });

  el.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - el.offsetLeft;
    const walk = (x - startX) * 1.2;
    el.scrollLeft = scrollLeft - walk;
  });

  let touchStartX = 0;
  let touchScrollLeft = 0;

  el.addEventListener("touchstart", (e) => {
    const touch = e.touches[0];
    touchStartX = touch.pageX;
    touchScrollLeft = el.scrollLeft;
  });

  el.addEventListener("touchmove", (e) => {
    const touch = e.touches[0];
    const walk = (touch.pageX - touchStartX) * 1.2;
    el.scrollLeft = touchScrollLeft - walk;
  });
}
