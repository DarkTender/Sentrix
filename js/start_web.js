console.log('Loader spustený');
    setTimeout(() => {
      console.log('Fade-out');
      document.getElementById('intro-loader').classList.add('fade-out');
      setTimeout(() => {
        console.log('PRESMERUJEM na index.html');
        window.location.href = 'index.html';
      }, 1000);
    }, 3500);