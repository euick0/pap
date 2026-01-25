import React from 'react';
import Image from "next/image";
import clsx from "clsx";

interface SidebarItemProps {
    size: number;
    text: string;
    imagePath: string;
    invert?: boolean;
}

const SidebarItem = ({size, text, imagePath, invert}: SidebarItemProps) => {
    //TODO resolver problemas tamanhos icons (provavel divs)
    return (
        <div
            className="w-full h-20 border-transparent border rounded-xl flex m-auto overflow-hidden cursor-pointer">
            <Image src={imagePath} alt="Sidebar Item Icon" width={size} height={size}
                   className={clsx("", {"invert": invert})}/>
            <p className="text-center ml-4 my-auto text-xl whitespace-nowrap text-neutral-100">{text}</p>
        </div>
    );
};

export default SidebarItem;
