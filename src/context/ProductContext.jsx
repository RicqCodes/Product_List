import React, { createContext, useRef, useState } from "react";
import useFormValidation from "../hook/useFormValidation";
import { validation } from "../helper/validation";

export const ProductContext = createContext();

const ProductProvider = ({ children }) => {
  const [selectedProduct, setSelectedProduct] = useState([]);
  const [products, setProducts] = useState([]);
  const [reload, setReload] = useState(false);
  // const [optionValue, setOptionValue] = useState("");
  const optionValue = useRef();
  const [productInput, setProductInput] = useState({});

  const {
    formData,
    errors,
    handleBlur,
    handleChange,
    checkIsValid,
    validateOnSubmit,
  } = useFormValidation(productInput, validation);
  console.log(productInput);
  return (
    <ProductContext.Provider
      value={{
        setProductInput,
        productInput,
        selectedProduct,
        setSelectedProduct,
        products,
        setProducts,
        reload,
        setReload,
        formData,
        errors,
        handleBlur,
        handleChange,
        checkIsValid,
        validateOnSubmit,
        // optionValue,
        // setOptionValue,
        optionValue,
      }}
    >
      {children}
    </ProductContext.Provider>
  );
};

export default ProductProvider;
