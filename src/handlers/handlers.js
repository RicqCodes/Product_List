import axios from "axios";

export const addProduct = async (productInput) => {
  const response = await axios.post(
    "http://localhost:80/product/api/save",
    productInput
  );
  return response.data;
};

export const getProducts = async () => {
  const response = await axios.get("http://localhost:80/product/api/products/");

  return response.data;
};

export const deleteProducts = async (deleteProducts) => {
  const response = await axios.patch(
    "http://localhost:80/product/api/mass-delete",
    deleteProducts
  );
  return response.data;
};
