import React, { useEffect, useContext } from "react";
import styled from "styled-components";
import { ProductContext } from "../context/ProductContext";
import { getProducts } from "../handlers/handlers";
import Card from "./molecules/Card";

const ProductList = () => {
  const { selectedProduct, setSelectedProduct, products, setProducts, reload } =
    useContext(ProductContext);

  useEffect(() => {
    const getAllproduct = async () => {
      const response = await getProducts();
      setProducts(response);
    };
    getAllproduct();
  }, [setProducts, reload]);

  return (
    <ProductListContainer>
      <ProductContainer>
        {products.length > 0 ? (
          products?.map((product, index) => (
            <Card
              key={index}
              data={product}
              selectedProduct={selectedProduct}
              setSelectedProduct={setSelectedProduct}
            />
          ))
        ) : (
          <NoContent>No product to display {":("}</NoContent>
        )}
      </ProductContainer>
    </ProductListContainer>
  );
};

export default ProductList;

const ProductListContainer = styled.div`
  width: 100%;
`;

const ProductContainer = styled.div`
  display: flex;
  padding-top: 24px;
  width: 100%;
  flex-wrap: wrap;
  gap: 48px;
`;

const NoContent = styled.div`
  display: flex;
  width: 100%;
  height: calc(100vh - 64px - 24px);
  align-items: center;
  justify-content: center;
`;
