import React from 'react';
import Image from "next/image";

interface LogoProps {
    width: number;
    height: number;
    iconType: "dark" | "light" | "textDark" | "textLight";
}

//TODO adicionar os varios estilos do icone
const Logo = ({width,height, iconType}: LogoProps) => {
    let iconSource = "/svgs/Reqal Icon - Dark Mode.svg"
    if (iconType === "dark") {
        iconSource = "/svgs/Reqal Logo - Dark Mode.svg"
    }
    else if (iconType === "light") {
        iconSource = "/svgs/Reqal Logo.svg"
    }
    else if (iconType === "textDark") {
        iconSource = "/svgs/Reqal Logo W-text - Dark Mode.svg"
    }
    else if (iconType === "textLight") {
        iconSource = "/svgs/Reqal Logo W-text.svg"
    }
    return (
        <div>
            <Image src={iconSource} alt="ReQal Logo" width={width} height={height}></Image>
        </div>
    );
};  

export default Logo;