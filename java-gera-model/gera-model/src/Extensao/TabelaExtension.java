/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Extensao;

import Entidade.Util;

/**
 *
 * @author ronney
 */
public class TabelaExtension
{
    public static String nomeArquivo(String tabela)
    {
        String[] split = tabela.split("_");
        String nome = "";
        
        if(split.length > 1)
        {
            for(int x = 0; x < split.length; x++)
            {
                nome += Util.primeiraMaiuscula(split[x]);
            }
        }
        else
        {
            nome = Util.primeiraMaiuscula(tabela);
        }
        
        return nome;
    }
}
