(function() {
  const canvas = document.getElementById('background');
  const ctx = document.getElementById('background').getContext('2d');
  let points = [],
    globalRotationSpeed = 0.3 * Math.PI / 180;
  let interval = null, active = true,
    resizeTimeout = null;
  class Point {
    constructor() {
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
      const r = Math.random() * Math.PI * 2;
      this.vx = Math.sin(r);
      this.vy = Math.cos(r);
      this.color = "#fff";
      this.size = 3;
      this.closestPoint = this;
      this.closestDist = null;
    }

    step() {
      this.x += this.vx;
      this.y += this.vy;
      this.x = canvas.width / 2 + Math.cos(globalRotationSpeed) * (this.x - canvas.width / 2) - Math.sin(globalRotationSpeed) * (this.y - canvas.height / 2);
      this.y = canvas.height / 2 + Math.sin(globalRotationSpeed) * (this.x - canvas.width / 2) + Math.cos(globalRotationSpeed) * (this.y - canvas.height / 2);
      if (this.x < this.size || this.y < this.size || this.x > canvas.width - this.size || this.y > canvas.height - this.size) {
        this.x = (this.x % canvas.width + canvas.width) % canvas.width;
        this.y = (this.y % canvas.height + canvas.height) % canvas.height;
      }
      this.closestDist = Infinity;
    }

    updateClosest() {
      for (p of points) {
        let d = Math.abs(this.x - p.x) + Math.abs(this.y - p.y);
        if (d == 0 || p.closestPoint == this) continue;
        if (d < this.closestDist) {
          this.closestDist = d;
          this.closestPoint = p;
        }
      }
    }

    draw() {
      ctx.save();
      ctx.translate(this.x, this.y);
      ctx.beginPath();
      ctx.moveTo(0, 0);
      ctx.strokeStyle = "#fff";
      ctx.lineTo(this.closestPoint.x - this.x, this.closestPoint.y - this.y);
      ctx.stroke();

      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(0, 0, this.size, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
    }
  }

  function onResize() {
    clearInterval(resizeTimeout);
    resizeTimeout = setTimeout(function() {
      canvas.width = $(window).width();
      canvas.height = $(window).height();
      if(active) {
        const nPoints = Math.floor(Math.sqrt(canvas.width * canvas.height) / 10);
        points = Array.from(new Array(nPoints), (p) => new Point());
        if (interval == null) toggle(true);
      }
    }, 200);
  }

  function toggle(state) {
    active = state;
    if(active) {
      clearInterval(interval);
      interval = setInterval(function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (p of points) p.step();
        for (p of points) p.updateClosest();
        for (p of points) p.draw();
      }, 1000 / 20);
    } else {
      clearInterval(interval);
      interval = null;
    }
  }

  onResize();
  $(window).resize(onResize);
  $(window).scroll(function() {
    if(active) {
      if($(this).scrollTop() >= canvas.height) toggle(false);
    } else {
      if($(this).scrollTop() < canvas.height) toggle(true);
    }
  });
})();
