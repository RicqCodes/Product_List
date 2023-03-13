import React, { useRef } from "react";
import styled from "styled-components";

const Card = ({ data, selectedProduct, setSelectedProduct }) => {
  const parseData = JSON.parse(data.properties);
  const inputRef = useRef();

  const handleChange = (e) => {
    const { checked, value } = e.target;
    if (checked) {
      setSelectedProduct((prev) => {
        return [...prev, value];
      });
    } else {
      setSelectedProduct(selectedProduct.filter((e) => e !== value));
    }
  };

  const handleClick = (e) => {
    if (e.target !== inputRef.current) {
      inputRef.current.checked = !inputRef.current.checked;

      const { checked, value } = inputRef.current;

      if (checked) {
        setSelectedProduct((prev) => {
          return [...prev, value];
        });
      } else {
        setSelectedProduct(selectedProduct.filter((e) => e !== value));
      }
    }
  };

  return (
    <CardContainer onClick={handleClick}>
      <CardContent>
        <InputContainer>
          <input
            ref={inputRef}
            type="checkbox"
            name="product"
            className="delete-checkbox"
            value={data.sku}
            onChange={handleChange}
            checked={selectedProduct?.includes(data.sku) ? true : false}
          />
        </InputContainer>
        <TextContent>
          <p>{data?.sku}</p>
          <p>{data?.name}</p>
          <p>${data?.price}</p>
          <p>
            {data?.type === "Dvd" || data?.type === "DVD"
              ? `Size: ${parseData?.size}MB`
              : data?.type === "Book" || data?.type === "BOOK"
              ? `Weight: ${parseData?.weight}KG`
              : data?.type === "FURNITURE" || data?.type === "Furniture"
              ? `Dimension: ${parseData?.height} x ${parseData?.width} x ${parseData?.length}`
              : ""}
          </p>
        </TextContent>
      </CardContent>
    </CardContainer>
  );
};

export default Card;

const CardContainer = styled.div`
  display: flex;
  max-width: 300px;
  width: 100%;
  height: 180px;
  border: 1px solid #000;
  border-radius: 5px;
  position: relative;
  transition: all 0.3s ease-in-out;
  cursor: pointer;

  @media (hover: hover) and (pointer: fine) {
    &:hover {
      scale: 1.05;
    }
  }
`;

const CardContent = styled.div`
  display: flex;
  padding: 24px;
  width: 100%;
  gap: 18px;
  align-items: center;
  justify-content: center;
`;

const InputContainer = styled.div`
  position: absolute;
  top: 24px;
  left: 24px;

  input {
    width: 100%;
  }
`;

const TextContent = styled.div`
  text-align: center;
  align-self: center;
  display: flex;
  flex-direction: column;
  gap: 10px;
`;
