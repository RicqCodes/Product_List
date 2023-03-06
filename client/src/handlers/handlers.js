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
  const res = await fetch(`${url}mass-delete/`, {
    method: "POST",
    body: JSON.stringify(deleteProducts),
  });

  const data = res.json();

  return data;
};
