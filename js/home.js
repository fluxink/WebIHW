// $(document).ready(function() {
//     var images = ['/assets/home1.png', '/assets/home2.png', '/assets/home3.png']; // список путей к изображениям
//     var currentIndex = 0; // текущий индекс изображения
//     var interval = setInterval(changeImage, 7000); // интервал времени в миллисекундах
  
//     function changeImage() {
//       // выбираем элемент
//       var imgElement = $('#big-img');
      
//       // плавно скрываем текущее изображение
//       imgElement.fadeOut(2000, function() {
//         // устанавливаем новый путь к изображению
//         imgElement.attr('src', images[currentIndex]);
        
//         // плавно отображаем новое изображение
//         imgElement.fadeIn(1000);
//       });
      
//       // увеличиваем индекс текущего изображения
//       currentIndex++;
      
//       // если достигнут конец списка изображений, возвращаемся к первому
//       if (currentIndex == images.length) {
//         currentIndex = 0;
//       }
//     }
//   });

$(document).ready(function() {
  $('.slideshow').cycle({
    fx: 'fadeout', // Тип анимации перехода (здесь "fade" для затухания)
    speed: 2000, // Скорость анимации (в миллисекундах)
    timeout: 4000 // Время показа каждого изображения (в миллисекундах)
  });
});

  