<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="SELECT * 
from f_trans_history_ws({i_lic_type_id},'{i_lic_no}')" activeCollection="SQLParameters" parameterTypeListName="ParameterTypeList" name="select_from_f_trans_histo" pageSizeLimit="100" wizardCaption="List of Select * From F Trans History Ws({i Lic Type Id},'{i Lic No}'); " wizardAllowInsert="False">
<Components>
<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="npwd" fieldSource="npwd">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="23" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_vat_setllement_id" fieldSource="t_vat_setllement_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="24" fieldSourceType="DBColumn" dataType="Float" html="False" name="t_cust_account_id" fieldSource="t_cust_account_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_name" fieldSource="company_name">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_pelaporan" fieldSource="periode_pelaporan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_pelaporan" fieldSource="tgl_pelaporan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="28" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_transaksi" fieldSource="total_transaksi">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="29" fieldSourceType="DBColumn" dataType="Float" html="False" name="total_pajak" fieldSource="total_pajak">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="kuitansi_pembayaran" fieldSource="kuitansi_pembayaran">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="False" name="tgl_pembayaran" fieldSource="tgl_pembayaran">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="32" fieldSourceType="DBColumn" dataType="Float" html="False" name="payment_amount" fieldSource="payment_amount">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="33" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_finance_period_id" fieldSource="p_finance_period_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_awal_laporan" fieldSource="periode_awal_laporan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_akhir_laporan" fieldSource="periode_akhir_laporan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="20" variable="i_lic_type_id" parameterType="URL" defaultValue="0" dataType="Float" parameterSource="i_lic_type_id"/>
<SQLParameter id="21" variable="i_lic_no" parameterType="URL" dataType="Text" parameterSource="i_lic_no"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="cek_izin.php" forShow="True" url="cek_izin.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
