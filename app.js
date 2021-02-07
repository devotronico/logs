console.log('APP');

const getData = () => {
  fetch('index.php', {
    method: 'GET',
    body: null,
    headers: { 'Content-Type': 'application/json' },
  })
    .then((response) => {
      console.log(response.json());
    })
    .catch((err) => {
      console.log(err);
    });
};

getData();
