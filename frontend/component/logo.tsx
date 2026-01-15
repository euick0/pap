import React from 'react';
import Image from "next/image";

interface LogoProps {
    width: number;
    height: number;
}

const Logo = ({width,height}: LogoProps) => {
    return (
        <div>
            <Image src="/svgs/Reqal Logo W-text - Dark Mode.svg" alt="ReQal Logo" width={width} height={height}></Image>
        </div>
    );
};  

export default Logo;