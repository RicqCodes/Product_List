import styled from "styled-components";

import { Loader } from "../../styles/element.styled";

const OverlayLoader = ({ transparent }) => {
  return (
    <Overlay>
      <Loader />
      <p>Adding Product</p>
    </Overlay>
  );
};

export default OverlayLoader;

const Overlay = styled.div`
  display: flex;
  flex-direction: column;
  gap: 16px;
  align-items: center;
  justify-content: center;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 999;
  background-color: rgba(0, 0, 0, 0.65);
  p {
    color: #fff;
  }
`;
