const url = "https://juniortest-prince-nwakanma.000webhostapp.com/api/";

export const addProduct = async (productInput) => {
  const res = await fetch(`${url}save/`, {
    method: "POST",
    body: JSON.stringify(productInput),
  });

  const data = res.json();

  return data;
};

export const getProducts = async () => {
  const res = await fetch(url);
  const data = res.json();

  return data;
};

export const deleteProducts = async (deleteProducts) => {
  console.log(deleteProducts);
  const res = await fetch(`${url}mass-delete/`, {
    method: "POST",
    body: JSON.stringify(deleteProducts),
  });

  console.log(res);
  const data = res.json();

  return data;
};
