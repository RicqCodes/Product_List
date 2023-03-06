import React, { useContext } from "react";
import styled from "styled-components";
import { Link, useLocation, useNavigate } from "react-router-dom";
import { toast } from "react-toastify";

import { Divider } from "../styles/element.styled";
import { ProductContext } from "../context/ProductContext";
import { addProduct, deleteProducts } from "../handlers/handlers";
import { device } from "../styles/utils.styled";

const Header = () => {
  const {
    productInput,
    setProductInput,
    selectedProduct,
    setSelectedProduct,
    setReload,
    reload,
    validateOnSubmit,
  } = useContext(ProductContext);
  const location = useLocation();
  const navigate = useNavigate();

  const handleSaveProduct = async () => {
    if (validateOnSubmit()) {
      const response = await addProduct(productInput);

      if (response.status === 1) {
        setProductInput(null);
        setTimeout(() => {
          navigate("/");
        }, 3000);
      } else {
        toast.error(response?.message);
      }
    }
  };

  const handleDeleteProducts = async () => {
    const response = await deleteProducts(selectedProduct);

    if (response.status === 1) {
      setSelectedProduct([]);
      setReload(!reload);
    } else {
      toast.error(response?.message);
    }
  };

  return (
    <HeaderContainer>
      <NavDetails>
        <p>
          {location.pathname === "/add-product"
            ? "Product Add"
            : "Product List"}
        </p>
        <NavButtonContainer>
          {location.pathname === "/add-product" ? (
            <>
              <button className="" type="button" onClick={handleSaveProduct}>
                Save
              </button>
              <Link to="/">Cancel</Link>
            </>
          ) : (
            <>
              <Link to="/add-product">Add</Link>
              <button
                className=".delete-checkbox"
                type="button"
                onClick={handleDeleteProducts}
                style={{ color: "red" }}
              >
                Mass Delete
              </button>
            </>
          )}
        </NavButtonContainer>
      </NavDetails>
      <Divider height="2px" />
    </HeaderContainer>
  );
};

export default Header;

const HeaderContainer = styled.div`
  display: flex;
  flex-direction: column;
  width: 100%;
`;

const NavDetails = styled.div`
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 64px;
`;

const NavButtonContainer = styled.div`
  display: flex;
  gap: 24px;

  ${() => device.down("sm")} {
    gap: 16px;
  }

  a,
  button {
    background-color: transparent;
    border: none;
    padding: 8px 18px;
    /* font-size: 14px; */
    font-weight: 500;
    cursor: pointer;
    text-transform: uppercase;
    box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease-in;

    @media (hover: hover) and (pointer: fine) {
      &:hover {
        box-shadow: 1px 1px 2px 1px rgba(0, 0, 0, 0.08);
      }
    }

    ${() => device.down("sm")} {
      padding: 8px 16px;
    }
  }
`;
