import React from "react";
import styled from "styled-components";
import { Divider } from "../styles/element.styled";

const Footer = () => {
  return (
    <FooterContainer>
      <Divider height="2px" />
      <FooterNote>Scandiweb Test assignment</FooterNote>
    </FooterContainer>
  );
};

export default Footer;

const FooterContainer = styled.div`
  width: 100%;
  padding-top: 48px;
`;

const FooterNote = styled.div`
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
  width: 100%;
`;
