import React, { useContext } from "react";
import styled from "styled-components";
import { ProductContext } from "../context/ProductContext";

const AddProduct = () => {
  const { productInput, setProductInput, errors, handleBlur, optionValue } =
    useContext(ProductContext);

  const options = ["Dvd", "Book", "Furniture"];

  const handleOnChange = (e) => {
    const { id, value } = e.target;

    if (
      id === "weight" ||
      id === "size" ||
      id === "length" ||
      id === "height" ||
      id === "width"
    ) {
      setProductInput((prev) => ({
        ...prev,
        properties: { ...prev.properties, [id]: value },
      }));
    } else {
      setProductInput((prev) => ({ ...prev, [id]: value }));
    }
  };

  const optionChangeHandler = (e) => {
    const { id, value } = e.target;

    setProductInput((prev) => ({
      ...prev,
      [id === "productType" ? "type" : id]: value,
    }));
    delete productInput?.properties;

    optionValue.current = e.target.value.toLowerCase();
  };

  return (
    <AddProductContainer>
      <Form id="product_form">
        <InputContainer>
          <div>
            <label htmlFor="sku">SKU</label>
            <div>
              <input
                type="text"
                id="sku"
                placeholder="Product unique id"
                onBlur={(e) => handleBlur(e)}
                onChange={handleOnChange}
              />
              <small>{errors.sku}</small>
            </div>
          </div>
          <div>
            <label htmlFor="sku">Name</label>
            <div>
              <input
                type="text"
                id="name"
                placeholder="Product name"
                onBlur={(e) => handleBlur(e)}
                onChange={handleOnChange}
              />
              <small>{errors.name}</small>
            </div>
          </div>
          <div>
            <label htmlFor="sku">Price ($)</label>
            <div>
              <input
                type="number"
                id="price"
                placeholder="Product price"
                onBlur={(e) => handleBlur(e)}
                onChange={handleOnChange}
              />
              <small>{errors.price}</small>
            </div>
          </div>
        </InputContainer>
        <TypeSelector>
          <div>
            <label>Type Switcher</label>
          </div>
          <Select className="select">
            <select id="productType" onChange={optionChangeHandler}>
              <option>Type Switcher</option>
              {options?.map((option, index) => (
                <option key={index}>{option.toUpperCase()}</option>
              ))}
            </select>
          </Select>
        </TypeSelector>
        <AttributeBox>
          {productInput?.type?.toLowerCase() === "dvd" && (
            <div>
              <AttrContainer>
                <LabelBox>
                  <label>Size (MB)</label>
                </LabelBox>
                <InputBox>
                  <input
                    id="size"
                    type="number"
                    onBlur={(e) => handleBlur(e)}
                    onChange={handleOnChange}
                  />
                  <small>{errors.size}</small>
                </InputBox>
              </AttrContainer>
              <small>Please provide size in MB format</small>
            </div>
          )}
          {productInput?.type?.toLowerCase() === "book" && (
            <div>
              <AttrContainer>
                <LabelBox>
                  <label>Weight (KG)</label>
                </LabelBox>
                <InputBox>
                  <input
                    id="weight"
                    type="number"
                    onBlur={(e) => handleBlur(e)}
                    onChange={handleOnChange}
                  />
                  <small>{errors.weight}</small>
                </InputBox>
              </AttrContainer>
              <small>Please provide weight in KG</small>
            </div>
          )}
          {productInput?.type?.toLowerCase() === "furniture" && (
            <div>
              <AttrContainer>
                <LabelBox>
                  <label htmlFor="height">Height (CM)</label>
                </LabelBox>
                <InputBox>
                  <input
                    id="height"
                    type="number"
                    onBlur={(e) => handleBlur(e)}
                    onChange={handleOnChange}
                  />
                  <small>{errors.height}</small>
                </InputBox>
              </AttrContainer>
              <AttrContainer>
                <LabelBox>
                  <label htmlFor="width">Width (CM)</label>
                </LabelBox>
                <InputBox>
                  <input
                    id="width"
                    type="number"
                    onBlur={(e) => handleBlur(e)}
                    onChange={handleOnChange}
                  />
                  <small>{errors.width}</small>
                </InputBox>
              </AttrContainer>
              <AttrContainer>
                <LabelBox>
                  <label htmlFor="length">Length (CM)</label>
                </LabelBox>
                <InputBox>
                  <input
                    id="length"
                    type="number"
                    onBlur={(e) => handleBlur(e)}
                    onChange={handleOnChange}
                  />
                  <small>{errors.length}</small>
                </InputBox>
              </AttrContainer>
              <small>Please provide dimensions in HxWxL format</small>
            </div>
          )}
        </AttributeBox>
      </Form>
    </AddProductContainer>
    // </Container>
  );
};

export default AddProduct;

const AddProductContainer = styled.div`
  display: flex;
  flex-direction: column;
  width: 100%;
  padding-top: 64px;
`;

const Form = styled.form`
  /* max-width: 450px; */
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 84px;
`;

const InputContainer = styled.div`
  display: flex;
  flex-direction: column;
  gap: 18px;
  max-width: 480px;
  width: 100%;

  > div {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;

    label {
      width: 82px;
    }

    > div {
      width: 100%;

      small {
        color: red;
      }

      input {
        width: 100%;
        border: 1px solid #000;
        height: 32px;
        padding: 12px;

        ::placeholder {
          font-size: 16px;
        }
      }
    }
  }
`;

const TypeSelector = styled.div`
  display: flex;
  gap: 32px;
  align-items: center;
`;

const Select = styled.div`
  width: 100%;
  min-width: 15ch;
  max-width: 30ch;
  border: 1px solid #000;
  padding: 6px 15px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  line-height: 1.1;
  background-color: #fff;
  background-image: linear-gradient(to top, #f9f9f9, #fff 33%);
  position: relative;

  &,
  select {
    grid-area: select;
    justify-self: end;
  }

  ::after {
    content: "";
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);

    width: 10px;
    height: 7px;
    background-color: var(--select-arrow);
    clip-path: polygon(100% 0%, 0 0%, 50% 100%);
  }

  ::before {
    content: "";
    position: absolute;
    height: 100%;
    background-color: #000;
    width: 1px;
    top: 0;
    right: 24px;
  }

  select {
    // A reset of styles, including removing the default dropdown arrow
    appearance: none;
    // Additional resets for further consistency
    background-color: transparent;
    border: none;
    padding: 0 1em 0 0;
    margin: 0;
    width: 100%;
    font-family: inherit;
    font-size: inherit;
    cursor: inherit;
    line-height: inherit;
    outline: none;

    select::-ms-expand {
      display: none;
    }
  }
`;

const AttributeBox = styled.div`
  max-width: 480px;
  width: 100%;

  > div {
    border: 1px solid #000;
    padding: 24px 12px;
  }

  p {
    padding: 18px 0px;
    font-size: 16px;
  }
`;

const AttrContainer = styled.div`
  width: 100%;

  display: flex;
  align-items: center;
`;

const LabelBox = styled.div`
  width: 20%;
`;

const InputBox = styled.div`
  padding: 12px;
  width: 80%;

  small {
    color: red;
  }

  input {
    width: 100%;
    border: 1px solid #000;
    height: 32px;
    padding: 12px;
  }
`;
