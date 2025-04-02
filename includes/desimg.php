<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Random Image Feed</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
   
    <div class="content"></div>

    <script src="app.js"></script>
     <script >
        document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".content");
  const baseURL = "https://picsum.photos/";
  const rows = 3;

  for (let i = 0; i < rows * 3; i++) {
    const img = document.createElement("img");
    img.className = "placeholder";
    img.dataset.src = `${baseURL}${randomSize()}`;
    container.appendChild(img);
  }

  const lazyLoadImages = () => {
    const images = document.querySelectorAll("img.placeholder");
    images.forEach((img) => {
      const rect = img.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        img.src = img.dataset.src;
        img.onload = () => img.classList.remove("placeholder");
      }
    });
  };

  window.addEventListener("scroll", lazyLoadImages);
  window.addEventListener("resize", lazyLoadImages);
  lazyLoadImages();

  function randomSize() {
    return `${randomNumber()}/${randomNumber()}`;
  }

  function randomNumber() {
    return Math.floor(Math.random() * 10) + 300;
  }
});

     </script>
  </body>
</html>

<style type="text/css">
* {
    box-sizing: border-box;
  }
  
  body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    font-family: sans-serif;
  }
  
  .content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    max-width: 1000px;
  }
  
  .content img {
    object-fit: cover;
    margin: 10px;
    height: 300px;
    width: 300px;
    max-width: 100%;
  }</style>